<?php
class Comentario
    {
        public function __construct(
            private int $id_avaliacao = 0,
            private int $id_usuario = 0,
            private int $nota = 0,
            private string $comentario = "",
            private string $data_avaliacao = "",
            private string $nome_usuario = "") {}

        public function getIdAvaliacao()
        {
            return $this->idavaliacao;
        }
    
        public function getIdUsuario()
        {
            return $this->idusuario;
        }
    
        public function getNota()
        {
            return $this->nota;
        }
    
        public function getComentario()
        {
            return $this->comentario;
        }
    
        public function getDataAvaliacao()
        {
            return date("d/m/Y H:i", strtotime($this->data_avaliacao));
        }
    
        public function getNomeUsuario()
        {
            return $this->nome_usuario;
        }
    }
?>