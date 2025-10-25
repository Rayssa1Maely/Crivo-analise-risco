<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class AnaliseController
{
    private $param;

    public function __construct()
    {
        $this->param = Conexao::getInstancia();
    }

    public function analisar()
    {
        $msg = ["","",""];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "Views/inicio.php";
            return;
        }

        if (empty($_POST['url']) || !filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
             http_response_code(400);
             echo '<p class="text-red-600 text-center">URL inválida ou não fornecida.</p>';
             return;
        }
        $urlParaAnalisar = $_POST['url'];

        $apiKeyVirusTotal = $_ENV['VIRUSTOTAL_API_KEY'] ?? null;
        $apiKeyWhois = $_ENV['WHOISXMLAPI_KEY'] ?? null;

        if (!$apiKeyVirusTotal || !$apiKeyWhois) {
            http_response_code(500);
            echo '<p class="text-red-600 text-center">Erro de configuração: Chaves de API não encontradas no arquivo .env.</p>';
            return;
        }

        $partesUrl = parse_url($urlParaAnalisar);
        $dominio = $partesUrl['host'] ?? null;
        if (!$dominio) {
             http_response_code(400);
             echo '<p class="text-red-600 text-center">URL inválida. Não foi possível extrair o domínio.</p>';
             return;
        }
        $dominio = preg_replace('/^www\./i', '', $dominio);


        $client = new Client(['timeout' => 15.0]);

        $dadosVirusTotal = null;
        $dadosWhois = null;
        $erroApi = null;

        try {
            $responsePost = $client->request('POST', 'https://www.virustotal.com/api/v3/urls', [
                'headers' => ['x-apikey' => $apiKeyVirusTotal],
                'form_params' => ['url' => $urlParaAnalisar]
            ]);
            $jsonPost = json_decode($responsePost->getBody()->getContents());

            if (!isset($jsonPost->data->id)) {
                throw new Exception("Resposta inesperada da API VirusTotal (POST)");
            }
            $analysisId = $jsonPost->data->id;

            sleep(3);
            $responseGet = $client->request('GET', 'https://www.virustotal.com/api/v3/analyses/' . $analysisId, [
                'headers' => ['x-apikey' => $apiKeyVirusTotal]
            ]);
            $dadosVirusTotal = json_decode($responseGet->getBody()->getContents());

        } catch (ClientException | RequestException $e) {
             $erroApi = "Erro ao contatar API VirusTotal: " . $e->getResponse()->getBody()->getContents();
        } catch (Exception $e) {
             $erroApi = "Erro (VirusTotal): " . $e->getMessage();
        }


        if (!$erroApi || strpos($erroApi, 'VirusTotal') !== false) {
             try {
                 $responseWhois = $client->request('GET', 'https://www.whoisxmlapi.com/whoisserver/WhoisService', [
                     'query' => [
                         'apiKey' => $apiKeyWhois,
                         'domainName' => $dominio,
                         'outputFormat' => 'JSON',
                         'da' => 2,
                     ]
                 ]);
                 $dadosWhois = json_decode($responseWhois->getBody()->getContents());

                 if (isset($dadosWhois->ErrorMessage)) {
                    throw new Exception("API WHOIS: " . $dadosWhois->ErrorMessage->msg);
                 }

             } catch (ClientException | RequestException $e) {
                 $erroApi .= ($erroApi ? "\n<br>" : "") . "Erro ao contatar API WHOIS: " . $e->getResponse()->getBody()->getContents();
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
        if ($dadosWhois && isset($dadosWhois->WhoisRecord->createdDate)) {
            try {
                 $dataCriacaoStr = $dadosWhois->WhoisRecord->createdDate;
                 $dataCriacao = new DateTime($dataCriacaoStr);
                 $agora = new DateTime();
                 $diferenca = $agora->diff($dataCriacao);
                 $mesesIdade = $diferenca->y * 12 + $diferenca->m;

                 if ($diferenca->y >= 2) { $idadeDominioTexto = "Criado há " . $diferenca->y . " anos"; }
                 elseif ($diferenca->y == 1) { $idadeDominioTexto = "Criado há 1 ano"; }
                 elseif ($diferenca->m >= 2) { $idadeDominioTexto = "Criado há " . $diferenca->m . " meses"; }
                 elseif ($diferenca->m == 1) { $idadeDominioTexto = "Criado há 1 mês"; }
                 else { $idadeDominioTexto = "Criado há " . $diferenca->d . ($diferenca->d > 1 ? " dias" : " dia"); }

            } catch (Exception $e) { $idadeDominioTexto = 'Data inválida'; }
        } elseif ($dadosWhois && !isset($dadosWhois->ErrorMessage)) {
             $idadeDominioTexto = 'Data de criação não informada';
        }

        $nivelRisco = 'Baixo'; $corRisco = 'green'; $pontuacao = 100;

        if ($pontuacaoMaliciosa >= 3) {
            $nivelRisco = 'Alto'; $corRisco = 'red'; $pontuacao -= 70;
        } elseif ($pontuacaoMaliciosa > 0) {
             $nivelRisco = 'Médio'; $corRisco = 'yellow'; $pontuacao -= 40;
        } elseif ($pontuacaoSuspeita > 0) {
             $nivelRisco = 'Médio'; $corRisco = 'yellow'; $pontuacao -= 20;
        }

        if ($mesesIdade !== null) {
            if ($mesesIdade < 3) {
                 if ($nivelRisco == 'Baixo') { $nivelRisco = 'Médio'; $corRisco = 'yellow'; }
                 elseif ($nivelRisco == 'Médio') { $nivelRisco = 'Alto'; $corRisco = 'red'; }
                 $pontuacao -= 50;
            } elseif ($mesesIdade < 6) {
                 if ($nivelRisco == 'Baixo') { $nivelRisco = 'Médio'; $corRisco = 'yellow'; }
                 $pontuacao -= 30;
            } elseif ($mesesIdade < 12) {
                 $pontuacao -= 10;
            }
        } else {
             $pontuacao -= 5;
        }

        $temSSL = false;
        try {
            $guzzleClientSSL = new Client(['timeout' => 5.0, 'verify' => true]);
            $guzzleClientSSL->request('GET', $urlParaAnalisar);
            $temSSL = true;
        } catch (RequestException $e) {
             if (strpos($e->getMessage(), 'SSL') === false && strpos($e->getMessage(), 'certificate') === false) {
                 if (strpos($urlParaAnalisar, 'https://') === 0) {
                    
                 } else {
                     $temSSL = false;
                 }
            } else {
                $temSSL = false;
            }
        } catch (Exception $e) {
            $temSSL = false;
        }

        if (!$temSSL && strpos($urlParaAnalisar, 'https://') === 0) {
             if ($nivelRisco == 'Baixo') { $nivelRisco = 'Médio'; $corRisco = 'yellow'; }
             $pontuacao -= 20;
        }


        $pontuacao = max(0, min(100, $pontuacao));

        $dadosParaView = [
            'url' => $urlParaAnalisar,
            'pontuacaoMaliciosa' => $pontuacaoMaliciosa,
            'pontuacaoSuspeita' => $pontuacaoSuspeita,
            'totalMecanismos' => $totalMecanismos,
            'nivelRisco' => $nivelRisco,
            'corRisco' => $corRisco,
            'pontuacao' => $pontuacao,
            'idadeDominio' => $idadeDominioTexto,
            'dataCriacao' => $dataCriacao,
            'temSSL' => $temSSL,
            'erroApi' => $erroApi,
        ];

        ob_start();
        extract($dadosParaView);
        require 'Views/resultado.php';
        $htmlResultado = ob_get_clean();

        echo $htmlResultado;

    }

    private function salvarAnaliseNoHistorico($idUsuario, $idSite, $nivelRisco, $detalhes) {
         try {
            $analiseDAO = new AnaliseDAO($this->param);
            $siteDAO = new SiteDAO($this->param);
            $idSiteReal = $siteDAO->obterOuCriarIdPelaUrl($urlParaAnalisar);

            if ($idSiteReal) {
                 $analiseObj = new Analise(0, $idUsuario, $idSiteReal, $nivelRisco, $detalhes);
                 $analiseDAO->salvar($analiseObj);
            }

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
                     $timeA = new DateTime($a->getDataAnaliseOriginal());
                     $timeB = new DateTime($b->getDataAnaliseOriginal());
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

}
?>