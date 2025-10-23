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
            $input = json_decode(file_get_contents('php://input'), true);
            $url = isset($input['url']) ? trim($input['url']) : '';

            if (empty($url)) {
                http_response_code(400);
                echo json_encode(['error' => 'URL é obrigatória.']);
                return;
            }

            try {
                $AnaliseSiteDAO = new AnaliseSiteDAO();
                $retorno = $AnaliseSiteDAO->analiseComVirusTotal($url);

                echo json_encode($retorno);

            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
            }
            require_once "Views/analisar.php";
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

        $analiseDAO = new AnaliseDAO($this->param);
        $historico = $analiseDAO->buscarPorUsuario($id_usuario);
        
        usort($historico, function($a, $b) {
            $timeA = DateTime::createFromFormat('d/m/Y H:i', $a->getDataAnalise());
            $timeB = DateTime::createFromFormat('d/m/Y H:i', $b->getDataAnalise());
            return $timeB->getTimestamp() - $timeA->getTimestamp();
        });

        require_once "Views/historico.php";
    }
    }
    
?>