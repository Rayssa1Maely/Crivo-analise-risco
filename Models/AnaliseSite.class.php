<?php
class AnaliseSite
    {
        public function __construct(
            private int $id = 0, 
            private string $url = "", 
            private string $nivelRisco = "", 
            private string $pontuacao = "", 
            private string $dataCriacaoDominio = "", 
            private string $estaEmListaNegra= "",
            private string $justificativa = "") {}

        public function getId()
        {
            return $this->id;
        }

        public function getUrl()
        {
            return $this->url;
        }

        public function getNivelRisco()
        {
            return $this->nivelRisco;
        }
        public function getPontuacao()
        {
            return $this->pontuacao;
        }

        public function getDataCriacaoDominio()
        {
            return $this->dataCriacaoDominio;
        }

        public function getEstaEmListaNegra()
        {
            return $this->estaEmListaNegra;
        }

        public function getJustificativa()
        {
            return $this->justificativa;
        }
    }
?>