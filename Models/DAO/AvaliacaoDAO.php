<?php
    class AvaliacaoDAO
    {
        public function __construct(private $db = null){}

        public function buscarTodas()
    {
        $sql = "SELECT a.*, u.nome FROM avaliacoes a JOIN usuarios u ON a.id_usuario = u.id_usuario";
        
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();
            
            $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
            $avaliacoes = [];

            if ($resultados) {
                foreach ($resultados as $linha) {
                    $avaliacoes[] = new Avaliacao(
                        $linha['idavaliacao'],
                        $linha['idusuario'],
                        $linha['nota'],
                        $linha['comentario'],
                        $linha['data_avaliacao'],
                        $linha['nome']
                    );
                }
            }
            
            return $avaliacoes;

        } catch (PDOException $e) {
            error_log("Erro ao buscar avaliações: " . $e->getMessage());
            return []; 
        }
    }

    public function adicionarAvaliacao($id_usuario, $nota, $comentario)
    {
        $sql = "INSERT INTO avaliacoes (id_usuario, nota, comentario) VALUES (?, ?, ?)";
        
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario);
            $stm->bindValue(2, $nota);
            $stm->bindValue(3, $comentario);
            $stm->execute();
            return true;
            
        } catch (PDOException $e) {
            error_log("Erro ao adicionar avaliação: " . $e->getMessage());
            return false;
        }
    }
    }
?>