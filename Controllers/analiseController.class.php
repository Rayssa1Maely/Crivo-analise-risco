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
        }
    }
    
?>