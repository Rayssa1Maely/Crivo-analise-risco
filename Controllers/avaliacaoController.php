<?php
class avaliacaoController
{
    private $param;
    public function __construct()
    {
        $this->param = Conexao::getInstancia();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        $avaliacaoDAO = new AvaliacaoDAO($this->param);
        $avaliacoes = $avaliacaoDAO->buscarTodas();

        $usuario_logado = isset($_SESSION['id_usuario']);
        $nome_usuario = $_SESSION['nome_usuario'] ?? ''; 

        $msg_feedback = null;
        if (isset($_SESSION['msg_avaliacao'])) {
            $msg_feedback = $_SESSION['msg_avaliacao'];
            unset($_SESSION['msg_avaliacao']); 
        }

        $dadosParaView = [
            'avaliacoes' => $avaliacoes,
            'usuario_logado' => $usuario_logado,
            'nome_usuario' => $nome_usuario,
            'msg_feedback' => $msg_feedback 
        ];
        extract($dadosParaView); 

        require_once "Views/avaliacoes.php";
    }

    public function salvar()
    {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: /crivo/login?erro=nao_logado");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['url_analisada']) && !empty($_POST['comentario']) ) 
        {
            $id_usuario = $_SESSION['id_usuario'];
            $comentario = trim(strip_tags($_POST['comentario'])); 
            $url_analisada = trim($_POST['url_analisada']);

            if (!filter_var($url_analisada, FILTER_VALIDATE_URL)) {
                $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'A URL informada não parece válida. Use o formato completo (ex: https://...).'];
            } else {
                $siteDAO = new SiteDAO($this->param);
                $id_site = $siteDAO->obterOuCriarIdPelaUrl($url_analisada);

                if ($id_site === null) {
                    $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Erro ao processar a URL informada no banco de dados. Tente novamente.'];
                } else {
                    $avaliacaoDAO = new AvaliacaoDAO($this->param);
                    if ($avaliacaoDAO->adicionarAvaliacao($id_usuario, $id_site, $comentario)) {
                        $_SESSION['msg_avaliacao'] = ['tipo' => 'sucesso', 'texto' => 'Sua avaliação foi enviada com sucesso! Obrigado por contribuir.'];
                    } else {
                        $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Erro ao salvar sua avaliação no banco de dados. Tente novamente.'];
                    }
                }
            }
        } else {
            $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Por favor, preencha a URL do site avaliado e o seu comentário.'];
        }

        header("Location: /crivo/avaliacoes");
        exit();
    }


}
?>