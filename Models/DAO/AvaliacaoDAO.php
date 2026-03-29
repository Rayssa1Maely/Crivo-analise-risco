<?php

class AvaliacaoDAO
{
    public function __construct(private $db = null) {}

    public function buscarTodas()
    {

        $sql = "SELECT a.id_avaliacao, a.id_usuario, a.id_site, a.comentario, a.data_avaliacao, a.nota,
                       u.nome as nome_usuario, s.url as url_analisada
                FROM avaliacoes a
                JOIN usuarios u ON a.id_usuario = u.id_usuario
                JOIN sites s ON a.id_site = s.id_site
                ORDER BY a.data_avaliacao DESC";

        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();

            $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
            $avaliacoes = [];

            if ($resultados) {
                foreach ($resultados as $linha) {
                    $avaliacoes[] = new Avaliacao(
                        (int)$linha['id_avaliacao'],
                        (int)$linha['id_usuario'],
                        (int)$linha['id_site'],
                        (string)$linha['url_analisada'],
                        (string)$linha['comentario'],
                        (string)$linha['data_avaliacao'],
                        (string)$linha['nome_usuario'],
                        (int)$linha['nota']
                    );
                }
            }

            return $avaliacoes;
        } catch (PDOException $e) {
            error_log("Erro ao buscar avaliações AvaliacaoDAO: " . $e->getMessage());
            return [];
        }
    }

    public function adicionarAvaliacao(int $id_usuario, int $id_site, string $comentario, int $nota)
    {
        $sql = "INSERT INTO avaliacoes (id_usuario, id_site, comentario, nota) VALUES (?, ?, ?, ?)";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario);
            $stm->bindValue(2, $id_site);
            $stm->bindValue(3, $comentario);
            $stm->bindValue(4, $nota);

            return $stm->execute();
        } catch (PDOException $e) {
            error_log("Erro ao adicionar avaliação AvaliacaoDAO: " . $e->getMessage());
            if ($e->getCode() == '23000') {
                error_log("Possível erro de chave estrangeira/duplicada ao adicionar avaliação.");
            }
            return false;
        }
    }

    public function buscarPorSite(int $id_site)
    {
        $sql = "SELECT a.*, u.nome as nome_usuario, s.url as url_analisada 
            FROM avaliacoes a
            JOIN usuarios u ON a.id_usuario = u.id_usuario
            JOIN sites s ON a.id_site = s.id_site
            WHERE a.id_site = ? 
            ORDER BY a.data_avaliacao DESC";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_site, PDO::PARAM_INT);
            $stm->execute();
            $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);

            $avaliacoes = [];
            foreach ($resultados as $linha) {
                $avaliacoes[] = new Avaliacao(
                    (int)$linha['id_avaliacao'],
                    (int)$linha['id_usuario'],
                    (int)$linha['id_site'],
                    (string)$linha['url_analisada'],
                    (string)$linha['comentario'],
                    (string)$linha['data_avaliacao'],
                    (string)$linha['nome_usuario'],
                    (int)$linha['nota'] 
                );
            }
            return $avaliacoes;
        } catch (PDOException $e) {
            return [];
        }
    }
}
