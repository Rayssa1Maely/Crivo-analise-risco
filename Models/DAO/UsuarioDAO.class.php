<?php
	class UsuarioDAO 
	{
		public function __construct(private $db = null){}
		
        public function cadastrar($usuario)
        {
            $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";

			try
			{
				$stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getNome());
		        $stm->bindValue(2, $usuario->getEmail());
		        $stm->bindValue(3, $usuario->getSenha());
				$stm->execute();
				$this->db = null;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao cadastrar usuario" . $e->getMessage());
			}
        }

        public function login($usuario)
        {
            $sql = "SELECT id_usuario, email FROM usuario 
                    WHERE email = ? AND senha = ?";

			try
			{
				$stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getEmail());
		        $stm->bindValue(2, $usuario->getEmail());
				$stm->execute();
				$this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao encontrar usuario" . $e->getMessage());
			}
        }
    }
?>        
