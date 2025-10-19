<?php
	class usuarioController
	{
		private $param;
		public function __construct()
		{
			$this->param = Conexao::getInstancia();
		}
		
        public function login()
		{
			$msg = ["","",""];

			if($_POST){
				$erro = false;

				if(empty($_POST["email"]))
				{
					$msg[0] = "Preencha o e-mail";
					$erro = true;
				}
				if(empty($_POST["senha"]))
				{
					$msg[1] = "Preencha senha";
					$erro = true;
				}

				if(!$erro){
					
					$usuario = new Usuario(0, "", $_POST["email"], $_POST["senha"]);

					$usuarioDAO = new UsuarioDAO($this->param);
					$retorno = $usuarioDAO->login($usuario);


					if ($retorno) {

						if (!isset($_SESSION)) {
							session_start();
						}
						$_SESSION["id_usuario"] = $retorno->getId();
						$_SESSION["id_usuario"] = $retorno->getNome();


						header("Location: /crivo/dashboard");
						exit();

					}else{
						$msg[2] = "Verifique os dados informados";
					}
				}
			}
			require_once "Views/fazerLogin.php";
			
		}

		public function cadastrar()
		{
			$msg = ["","","",""];
			
			if($_POST){
				$erro = false;
				if(empty($_POST["nome"])){
					$msg[0] = "Preencha o campo com o nome";
					$erro = true;
				}
				if(empty($_POST["email"])){
					$msg[1] = "Preencha o campo com o email";
					$erro = true;
				} 
				if(empty($_POST["senha"])){
					$msg[2] = "Preencha o campo com a senha";
					$erro = true;
				} 
				if($_POST["confirmar-senha"] != $_POST["senha"]){
					$msg[3] = "Verifique se as senhas estão iguais";
					$erro = true;
				} 


				if(!$erro){
				$senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);

				$usuario = new Usuario(0, $_POST["nome"], $_POST["email"], $senhaCriptografada);

				$usuarioDAO = new UsuarioDAO($this->param);
				$usuarioDAO->cadastrar($usuario);
				header("Location: crivo/dashboard");

				}
			}
			require_once "Views/cadastrar.php";
		}

		public function dashboard()
		{
			require_once "Views/inicio.php";
		}

		

	}
?>