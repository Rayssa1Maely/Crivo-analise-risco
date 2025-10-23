<?php
    class AnaliseDAO 
    {
        public function __construct(private $db = null){}

        public function buscarPorUsuario($id_usuario)
    {
        $sql = "SELECT * FROM analises WHERE id_usuario = ?";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario);
            $stm->execute();
            
            $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
            $historico = [];

            if ($resultados) {
                foreach ($resultados as $linha) {
                    $historico[] = new Analise(
                        $linha['id_analise'],
                        $linha['id_usuario'],
                        $linha['url_analisada'],
                        $linha['resultado_analise'],
                        $linha['data_analise']
                    );
                }
            }
            
            return $historico;

        } catch (PDOException $e) {
            error_log("Erro ao buscar histórico: " . $e->getMessage());
            return []; 
        }
    }

    public function adicionarAnalise($id_usuario, $url, $resultado)
    {
        $sql = "INSERT INTO analises (id_usuario, url_analisada, resultado_analise) VALUES (?, ?, ?)";
        
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario);
            $stm->bindValue(2, $url);
            $stm->bindValue(3, $resultado);
            $stm->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao adicionar análise: " . $e->getMessage());
            return false;
        }
    }
    }
?>