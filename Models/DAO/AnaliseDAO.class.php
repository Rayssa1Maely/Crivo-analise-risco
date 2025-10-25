<?php
class AnaliseDAO
{
    public function __construct(private $db = null)
    {
    }

    public function buscarPorUsuario($id_usuario)
    {
        $sql = "SELECT a.id_analise, a.id_usuario, s.url as url_analisada, a.resultado_risco as resultado_analise, a.data_analise
                FROM analises a
                JOIN sites s ON a.id_site = s.id_site
                WHERE a.id_usuario = ?
                ORDER BY a.data_analise DESC";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $stm->execute();
            $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);

            $historico = [];
            foreach ($resultados as $res) {
                $historico[] = new Analise(
                    $res['id_analise'],
                    $res['id_usuario'],
                    $res['url_analisada'],
                    $res['resultado_analise'],
                    $res['data_analise']
                );
            }
            return $historico;

        } catch (PDOException $e) {
            error_log("Erro ao buscar histórico: " . $e->getMessage());
            return [];
        }
    }

    public function salvar(int $id_usuario, int $id_site, string $resultadoRisco, ?string $detalhes = null): bool
    {
        $sql = "INSERT INTO analises (id_usuario, id_site, resultado_risco, detalhes)
                VALUES (?, ?, ?, ?)";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $id_usuario, PDO::PARAM_INT);
            $stm->bindValue(2, $id_site, PDO::PARAM_INT);
            $stm->bindValue(3, $resultadoRisco);
            $stm->bindValue(4, $detalhes, $detalhes === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

            return $stm->execute();

        } catch(PDOException $e) {
            error_log("Erro ao salvar análise: " . $e->getMessage());
            return false;
        }
    }


}
?>