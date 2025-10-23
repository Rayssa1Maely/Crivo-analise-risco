<?php
class Analise
{
    public function __construct(
        private int $id_analise = 0,
        private int $id_usuario = 0,
        private string $url_analisada = "",
        private string $resultado_analise = "", 
        private string $data_analise = ""
    ) {}

    public function getIdAnalise()
    {
        return $this->id_analise;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getUrlAnalisada()
    {
        return $this->url_analisada;
    }

    public function getResultadoAnalise()
    {
        return $this->resultado_analise;
    }

    public function getDataAnalise()
    {
        return date("d/m/Y H:i", strtotime($this->data_analise));
    }
}
?>