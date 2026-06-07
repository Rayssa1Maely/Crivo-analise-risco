<?php

class AnaliseController
{
    private $param;

    public function __construct()
    {
        $this->param = Conexao::getInstancia();
    }

    public function analisar()
    {
        $msg = ["", "", ""];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "Views/inicio.php";
            return;
        }

        if (empty($_POST['url'])) {
            http_response_code(400);
            echo '<p class="text-red-600 text-center">URL não fornecida.</p>';
            return;
        }
        
        $urlParaAnalisar = trim($_POST['url']);

        if (strpos($urlParaAnalisar, 'http://') !== 0 && strpos($urlParaAnalisar, 'https://') !== 0) {
            $urlParaAnalisar = 'https://' . $urlParaAnalisar;
        }

        if (!filter_var($urlParaAnalisar, FILTER_VALIDATE_URL)) {
            http_response_code(400);
            echo '<p class="text-red-600 text-center">O formato do link é inválido.</p>';
            return;
        }

        $partesUrl = parse_url($urlParaAnalisar);

        if (isset($partesUrl['user']) || isset($partesUrl['pass'])) {
            http_response_code(400);
            echo '<p class="text-red-600 text-center">A URL contém um formato suspeito ou não permitido.</p>';
            return;
        }

        $dominio = $partesUrl['host'] ?? null;
    
        if (!$dominio) {
            http_response_code(400);
            echo '<p class="text-red-600 text-center">URL inválida. Não foi possível extrair o domínio.</p>';
            return;
        }
        
        $dominio = preg_replace('/^www\./i', '', $dominio);

        if (!checkdnsrr($dominio, "A") && !checkdnsrr($dominio, "AAAA")) {
            http_response_code(400);
            echo '<p class="text-red-600 text-center">O domínio informado não existe ou está fora do ar.</p>';
            return;
        }

        $avaliacoesDoSite = [];
        $apiKeyVirusTotal = $_ENV['VIRUSTOTAL_API_KEY'] ?? null;
        $apiKeyWhois = $_ENV['WHOISXMLAPI_KEY'] ?? null;

        if (!$apiKeyVirusTotal || !$apiKeyWhois) {
            http_response_code(500);
            echo '<p class="text-red-600 text-center">Erro de configuração: Chaves de API não encontradas no arquivo .env.</p>';
            return;
        }


        $dadosVirusTotal = null;
        $dadosWhois = null;
        $erroApi = null;

        try {
            $postData = 'url=' . urlencode($urlParaAnalisar);
            $ch = curl_init('https://www.virustotal.com/api/v3/urls');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'x-apikey: ' . $apiKeyVirusTotal,
                'Content-Type: application/x-www-form-urlencoded'
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);

            $responsePost = curl_exec($ch);
            $jsonPost = json_decode($responsePost);
            curl_close($ch);

            if (!isset($jsonPost->data->id)) {
                throw new Exception("Resposta inesperada da API VirusTotal (POST)");
            }
            $analysisId = $jsonPost->data->id;

            sleep(3);

            $ch = curl_init('https://www.virustotal.com/api/v3/analyses/' . $analysisId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['x-apikey: ' . $apiKeyVirusTotal]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);

            $responseGet = curl_exec($ch);
            $dadosVirusTotal = json_decode($responseGet);
            curl_close($ch);
        } catch (Exception $e) {
            $erroApi = "Erro (VirusTotal): " . $e->getMessage();
        }

        if (!$erroApi) {
            try {
                $urlWhois = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$apiKeyWhois&domainName=$dominio&outputFormat=JSON&da=2";
                $ch = curl_init($urlWhois);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_TIMEOUT, 20);

                $responseWhois = curl_exec($ch);
                $dadosWhois = json_decode($responseWhois);
                curl_close($ch);

                if (isset($dadosWhois->ErrorMessage)) {
                    throw new Exception("API WHOIS: " . $dadosWhois->ErrorMessage->msg);
                }
            } catch (Exception $e) {
                $erroApi .= ($erroApi ? "\n<br>" : "") . "Erro (WHOIS): " . $e->getMessage();
            }
        }


        $pontuacaoMaliciosa = 0;
        $pontuacaoSuspeita = 0;
        $totalMecanismos = 0;

        if ($dadosVirusTotal && isset($dadosVirusTotal->data->attributes->stats)) {
            $stats = $dadosVirusTotal->data->attributes->stats;
            $pontuacaoMaliciosa = $stats->malicious ?? 0;
            $pontuacaoSuspeita = $stats->suspicious ?? 0;
            $totalMecanismos = ($stats->harmless ?? 0) + $pontuacaoMaliciosa + $pontuacaoSuspeita + ($stats->undetected ?? 0);
        }

        $idadeDominioTexto = 'Indisponível';
        $dataCriacao = null;
        $mesesIdade = null;
        $dataCriacaoStr = null;

        if ($dadosWhois && isset($dadosWhois->WhoisRecord)) {
            $whois = $dadosWhois->WhoisRecord;
            
            if (isset($whois->createdDateNormalized)) {
                $dataCriacaoStr = $whois->createdDateNormalized;
            } 
            elseif (isset($whois->registryData->createdDateNormalized)) {
                $dataCriacaoStr = $whois->registryData->createdDateNormalized;
            } 
            elseif (isset($whois->createdDate)) {
                $dataCriacaoStr = $whois->createdDate;
            } 
            elseif (isset($whois->registryData->createdDate)) {
                $dataCriacaoStr = $whois->registryData->createdDate;
            }
        }

        if ($dataCriacaoStr !== null) {
            try {
                $dataCriacao = new DateTime($dataCriacaoStr);
                $agora = new DateTime();
                $diferenca = $agora->diff($dataCriacao);
                $mesesIdade = $diferenca->y * 12 + $diferenca->m;

                if ($diferenca->y >= 2) {
                    $idadeDominioTexto = "Criado há " . $diferenca->y . " anos";
                } elseif ($diferenca->y == 1) {
                    $idadeDominioTexto = "Criado há 1 ano";
                } elseif ($diferenca->m >= 2) {
                    $idadeDominioTexto = "Criado há " . $diferenca->m . " meses";
                } elseif ($diferenca->m == 1) {
                    $idadeDominioTexto = "Criado há 1 mês";
                } else {
                    $idadeDominioTexto = "Criado há " . $diferenca->d . ($diferenca->d > 1 ? " dias" : " dia");
                }
            } catch (Exception $e) {
                $idadeDominioTexto = 'Data inválida';
            }
        } elseif ($dadosWhois && !isset($dadosWhois->ErrorMessage)) {
            $idadeDominioTexto = 'Data de criação não informada';
        }

        $nivelRisco = 'Baixo';
        $corRisco = 'green';
        $pontuacao = 100;

        if ($pontuacaoMaliciosa >= 3) {
            $nivelRisco = 'Alto';
            $corRisco = 'red';
            $pontuacao -= 70;
        } elseif ($pontuacaoMaliciosa > 0) {
            $nivelRisco = 'Médio';
            $corRisco = 'yellow';
            $pontuacao -= 40;
        } elseif ($pontuacaoSuspeita > 0) {
            $nivelRisco = 'Médio';
            $corRisco = 'yellow';
            $pontuacao -= 20;
        }

        if ($mesesIdade !== null) {
            if ($mesesIdade < 3) {
                if ($nivelRisco == 'Baixo') {
                    $nivelRisco = 'Médio';
                    $corRisco = 'yellow';
                } elseif ($nivelRisco == 'Médio') {
                    $nivelRisco = 'Alto';
                    $corRisco = 'red';
                }
                $pontuacao -= 50;
            } elseif ($mesesIdade < 6) {
                if ($nivelRisco == 'Baixo') {
                    $nivelRisco = 'Médio';
                    $corRisco = 'yellow';
                }
                $pontuacao -= 30;
            } elseif ($mesesIdade < 12) {
                $pontuacao -= 10;
            }
        } else {
            $pontuacao -= 40;
            $idadeDominioTexto = "Não foi possível verificar a idade (Suspeito)";
        }

        $temSSL = false;
        $ch = curl_init($urlParaAnalisar);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_exec($ch);
        if (!curl_errno($ch)) {
            $temSSL = true;
        }
        curl_close($ch);

        if (!$temSSL || strpos($urlParaAnalisar, 'https://') !== 0) {
            if ($nivelRisco == 'Baixo') {
                $nivelRisco = 'Médio';
                $corRisco = 'yellow';
            }
            $pontuacao -= 25;
        }

        $pontuacao = max(0, min(100, $pontuacao));

        $siteDAO = new SiteDAO($this->param);
        $idSite = $siteDAO->obterOuCriarIdPelaUrl($urlParaAnalisar);
        
        if ($idSite) {
            $avaliacaoDAO = new AvaliacaoDAO($this->param);
            $avaliacoesDoSite = $avaliacaoDAO->buscarPorSite($idSite);
        }
        $parecerIaTexto = $this->gerarParecerComIA($urlParaAnalisar, $nivelRisco, $idadeDominioTexto, $totalMecanismos);

        $idAnaliseRecente = $this->salvarAnaliseNoHistorico($urlParaAnalisar, $nivelRisco, $pontuacao, $parecerIaTexto);

        $dadosParaView = [
            'url' => $urlParaAnalisar,
            'pontuacaoMaliciosa' => $pontuacaoMaliciosa,
            'pontuacaoSuspeita' => $pontuacaoSuspeita,
            'totalMecanismos' => $totalMecanismos,
            'nivelRisco' => $nivelRisco,
            'corRisco' => $corRisco,
            'avaliacoes' => $avaliacoesDoSite,
            'idAnaliseRecente' => $idAnaliseRecente,
            'pontuacao' => $pontuacao,
            'idadeDominio' => $idadeDominioTexto,
            'dataCriacao' => $dataCriacao,
            'mesesIdade' => $mesesIdade,
            'temSSL' => $temSSL,
            'erroApi' => $erroApi
        ];

        ob_start();
        extract($dadosParaView);
        require 'Views/resultado.php';
        $htmlResultado = ob_get_clean();

        echo $htmlResultado;
    }

    private function salvarAnaliseNoHistorico($urlParaAnalisar, $nivelRisco, $pontuacao, $parecerIa)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id_usuario'])) {
            return false;
        }

        try {
            $idUsuario = $_SESSION['id_usuario'];
            $siteDAO = new SiteDAO($this->param);
            $idSite = $siteDAO->obterOuCriarIdPelaUrl($urlParaAnalisar);
            
            
            if ($idSite) {
                $analiseDAO = new AnaliseDAO($this->param);
                $detalhes = "Pontuação final: " . $pontuacao . "/100";
                return $analiseDAO->salvar($idUsuario, $idSite, $nivelRisco, $detalhes, $parecerIa);
            }
            return false; 

        } catch (Exception $e) {
            error_log("Erro ao salvar análise no histórico: " . $e->getMessage());
        }
    }

    public function historico()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id_usuario'])) {
            header("Location: /crivo/login");
            exit();
        }

        $id_usuario = $_SESSION['id_usuario'];
        $nome_usuario = $_SESSION['nome_usuario'] ?? 'Usuário';

        try {
            $analiseDAO = new AnaliseDAO($this->param);
            $historico = $analiseDAO->buscarPorUsuario($id_usuario);
        } catch (Exception $e) {
            $historico = [];
            $erroHistorico = "Erro ao buscar histórico: " . $e->getMessage();
        }

        if (!empty($historico)) {
            usort($historico, function ($a, $b) {
                try {
                    $timeA = new DateTime($a->getDataAnalise());
                    $timeB = new DateTime($b->getDataAnalise());
                    return $timeB->getTimestamp() - $timeA->getTimestamp();
                } catch (Exception $e) {
                    return 0;
                }
            });
        }

        $dadosViewHistorico = [
            'nome_usuario' => $nome_usuario,
            'historico' => $historico,
            'erroHistorico' => $erroHistorico ?? null
        ];

        extract($dadosViewHistorico);
        require_once "Views/historico.php";
    }

    public function verRelatorio()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $idAnalise = $_GET['id'] ?? null; 

        if (!$idAnalise) {
            echo "Erro: O ID não chegou ao Controller. <br>";
            echo "URL completa detectada pelo servidor: " . $_SERVER['REQUEST_URI'];
            exit(); 
        }

        $analiseDAO = new AnaliseDAO($this->param);
        $analise = $analiseDAO->buscarPorId($idAnalise);

        if (!$analise) {
            die("Análise com o ID $idAnalise não encontrada no banco de dados.");
        }

        $siteDAO = new SiteDAO($this->param);
        $idSite = $siteDAO->obterOuCriarIdPelaUrl($analise->getUrlAnalisada());
        
        $avaliacoes = [];
        if ($idSite) {
            $avaliacaoDAO = new AvaliacaoDAO($this->param);
            $avaliacoes = $avaliacaoDAO->buscarPorSite($idSite);
        }

        require_once "Views/relatorio.php";
    }

    private function gerarParecerComIA($url, $nivelRisco, $idadeDominio, $totalMecanismos)
    {
        $apiKey = $_ENV['GEMINI_API_KEY'] ?? null;
        if (!$apiKey) return "Erro interno: Chave da API (GEMINI_API_KEY) não encontrada no .env!";

        $prompt = "Ajas como um analista sénior de cibersegurança do sistema 'Crivo'. Analisa de forma rápida o site: $url. O risco detetado pelas APIs é $nivelRisco. A idade do domínio é $idadeDominio. Total de motores a analisar: $totalMecanismos. Escreve um parecer direto e amigável para o utilizador comum em 3 frases, explicando se ele pode confiar ou não no site com base nestes dados. Sê incisivo. Não uses formatação (asteriscos, negritos).";

        $urlApi = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

        $dados = [
            "contents" => [
                ["parts" => [["text" => $prompt]]]
            ]
        ];

        $ch = curl_init($urlApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 

        $resposta = curl_exec($ch);
        $erroCurl = curl_error($ch);
        curl_close($ch);

        if ($erroCurl) {
            return "Erro de conexão (cURL): " . $erroCurl;
        }

        if ($resposta) {
            $json = json_decode($resposta, true);
            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                return $json['candidates'][0]['content']['parts'][0]['text'];
            } else {
                return "Google recusou a conexão. Motivo: " . $resposta;
            }
        }
        return "Sem resposta do servidor.";
    }
}
