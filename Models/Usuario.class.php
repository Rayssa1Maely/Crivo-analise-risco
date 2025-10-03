<?php
class Usuario
    {
        public function __construct(private int $id = 0, private string $nome = "", private string $email = "", private string $senha = "") {}

        public function getId()
        {
            return $this->id;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function getEmail()
        {
            return $this->email;
        }
        public function getSenha()
        {
            return $this->senha;
        }
    }
?>
