<?php
    class SiteDAO
    {
        public function __construct(private $db = null){}

        public function obterOuCriarIdPelaUrl($url)
    {
        $sqlSelect = "SELECT id_site FROM sites WHERE url = ?";
        try {
            $stmSelect = $this->db->prepare($sqlSelect);
            $stmSelect->bindValue(1, $url);
            $stmSelect->execute();
            $resultado = $stmSelect->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return $resultado['id_site'];
            }

            $sqlInsert = "INSERT INTO sites (url) VALUES (?)";
            $stmInsert = $this->db->prepare($sqlInsert);
            $stmInsert->bindValue(1, $url);

            if ($stmInsert->execute()) {
                return $this->db->lastInsertId();
            } else {
                error_log("Erro ao inserir nova URL no SiteDAO: " . implode(":", $stmInsert->errorInfo()));
                return null;
            }

        } catch(PDOException $e) {
            error_log("Erro no SiteDAO->obterOuCriarIdPelaUrl: " . $e->getMessage());
            return null;
        }
    }
    }
?>