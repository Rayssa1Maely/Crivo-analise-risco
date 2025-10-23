<?php
	class UsuarioDAO 
	{
		public function __construct(private $db = null){}
		
        public function cadastrar($usuario)
        {
            $sql = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)";

			try
			{
				$stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getNome());
		        $stm->bindValue(2, $usuario->getEmail());
		        $stm->bindValue(3, $usuario->getSenha());
				$stm->execute();
				return true;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao cadastrar usuario" . $e->getMessage());
				return false;
			}
        }

        public function login($usuario)
        {
            $sql = "SELECT id_usuario, email FROM usuarios 
                    WHERE email = ? AND senha_hash = ?";

			try
			{
				$stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getEmail());
		        $stm->bindValue(2, $usuario->getSenha());
				$stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao encontrar usuario" . $e->getMessage());
			}
        }

		public function emailJaExiste($email)
		{
			$sql = "SELECT id_usuario FROM usuarios WHERE email = ?";                        

			try
			{
				$stm = $this->db->prepare($sql);
                $stm->bindValue(1, $email);
				$stm->execute();
                return $stm->fetch(PDO::FETCH_ASSOC) !== false;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao verificar email" . $e->getMessage());
			}
		}
    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $email);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC); 
            
            if ($result) {
                return new Usuario(
                    $result['id_usuario'], 
                    $result['nome'], 
                    $result['email'], 
                    $result['senha_hash']
                );
            } else {
                return false;
            }
            
        } catch(PDOException $e) {
            die("Problema ao buscar usuário por e-mail: " . $e->getMessage());
        }
    }
		

    }
?>        
