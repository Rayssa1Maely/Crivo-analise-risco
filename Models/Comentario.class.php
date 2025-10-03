<?php
class Comentario
    {
        public function __construct(
            private int $id = 0, 
            private string $textoComentado = "", 
            private string $data = "", 
            private $usuario = null,
            private string $urlAnalisada = "") {}

        public function getId()
        {
            return $this->id;
        }

        public function getTextoComentado()
        {
            return $this->textoComentado;
        }

        public function getData()
        {
            return $this->data;
        }
        public function getUrlAnalisada()
        {
            return $this->urlAnalisada;
        }
    }
?>