<?php
class Avaliacao
{
    public function __construct(
        private int $id_avaliacao = 0,
        private int $id_usuario = 0,
        private $id_site = 0,
        private string $url_analisada = "",
        private string $comentario = "",
        private string $data_avaliacao = "",
        private string $nome_usuario = ""
    ) {
    }

    public function getIdAvaliacao()
    {
        return $this->id_avaliacao;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getIdSite()
    {
        return $this->id_site;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getDataAvaliacaoOriginal()
    {
        return $this->data_avaliacao;
    }

    public function getDataAvaliacaoFormatada()
    {
        return date("d/m/Y H:i", strtotime($this->data_avaliacao));
    }

    public function getNomeUsuario()
    {
        return $this->nome_usuario;
    }

    public function getUrlAnalisada()
    {
        return $this->url_analisada;
    }
}
?>