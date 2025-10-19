<?php
	class AnaliseSiteDAO 
	{
		public function __construct(private $db = null){}
		
          public function salvarAnalise($analise)
    {
        
        $sql = "INSERT INTO analise (id_usuario, resultado_risco, detalhes, data_analise, id_site) 
                VALUES (?, ?, ?, NOW(), ?)";

        try
        {
            $stm = $this->db->prepare($sql);

            $stm->bindValue(1, $analise->getIdUsuario());
            $stm->bindValue(2, $analise->getResultadoRisco());
            $stm->bindValue(3, $analise->getDetalhes());
            $stm->bindValue(4, $analise->getIdSite());
            
            $stm->execute();
            

            $this->db = null;
        }
        catch(PDOException $e)
        {
            $this->db = null;
            die("Problema ao salvar a análise: " . $e->getMessage());
        }
    }

    }
?>