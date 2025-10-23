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

            usort($avaliacoes, function($a, $b) {
                $timeA = DateTime::createFromFormat('d/m/Y H:i', $a->getDataAvaliacao());
                $timeB = DateTime::createFromFormat('d/m/Y H:i', $b->getDataAvaliacao());
                return $timeB->getTimestamp() - $timeA->getTimestamp();
            });

            $usuario_logado = isset($_SESSION['id_usuario']);
            $nome_usuario = $_SESSION['nome_usuario'] ?? '';

            require_once "Views/avaliacoes.php";
        }

        public function salvar()
        {
            if (!isset($_SESSION['id_usuario'])) {
                header("Location: /crivo/login");
                exit();
            }

            if ($_POST && !empty($_POST['nota']) && !empty($_POST['comentario'])) {
                
                $id_usuario = $_SESSION['id_usuario'];
                $nota = (int)$_POST['nota'];
                $comentario = trim($_POST['comentario']);

                if ($nota >= 1 && $nota <= 5) {
                    $avaliacaoDAO = new AvaliacaoDAO($this->param);
                    
                    if ($avaliacaoDAO->adicionarAvaliacao($id_usuario, $nota, $comentario)) {
                        $_SESSION['msg_avaliacao'] = ['tipo' => 'sucesso', 'texto' => 'Sua avaliação foi enviada!'];
                    } else {
                        $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Erro ao salvar sua avaliação. Tente novamente.'];
                    }
                } else {
                    $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Por favor, selecione uma nota de 1 a 5.'];
                }
            } else {
                $_SESSION['msg_avaliacao'] = ['tipo' => 'erro', 'texto' => 'Por favor, preencha a nota e o comentário.'];
            }

            header("Location: /crivo/avaliacoes");
            exit();
        }

    }
?>