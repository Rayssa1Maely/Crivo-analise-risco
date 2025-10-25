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
		$msg = ["", "", ""];

		if ($_POST) {
			$erro = false;

			if (empty($_POST["email"])) {
				$msg[0] = "Preencha o e-mail";
				$erro = true;
			}
			if (empty($_POST["senha"])) {
				$msg[1] = "Preencha senha";
				$erro = true;
			}

			if (!$erro) {

				$usuarioDAO = new UsuarioDAO($this->param);
				$usuarioEncontrado = $usuarioDAO->buscarPorEmail($_POST["email"]);

				if ($usuarioEncontrado && password_verify($_POST["senha"], $usuarioEncontrado->getSenha())) {

					if (!isset($_SESSION)) {
						session_start();
					}

					$_SESSION["id_usuario"] = $usuarioEncontrado->getId();
					$_SESSION["nome_usuario"] = $usuarioEncontrado->getNome();


					header("Location: /crivo/dashboard");
					exit();

				} else {
					$msg[2] = "Verifique os dados informados";
				}
			}
		}
		require_once "Views/fazerLogin.php";

	}

	public function cadastrar()
	{
		$msg = ["", "", "", "", ""];

		if ($_POST) {
			$erro = false;

			if (empty($_POST["nome"])) {
				$msg[0] = "Preencha o campo com o nome";
				$erro = true;
			}

			if (empty($_POST["email"])) {
				$msg[1] = "Preencha o campo com o email";
				$erro = true;
			} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				$msg[1] = "O formato do e-mail é inválido. Ex: seu.email@exemplo.com";
				$erro = true;
			} else {
				$dominio = explode('@', $_POST["email"])[1];
				if (!checkdnsrr($dominio, "MX")) {
					$msg[1] = "O domínio deste e-mail não parece ser válido.";
					$erro = true;
				}
			}

			if (empty($_POST["senha"])) {
				$msg[2] = "Preencha o campo com a senha";
				$erro = true;
			}

			if (empty($_POST["confirmar-senha"])) {
				$msg[3] = "Por favor, confirme sua senha";
				$erro = true;
			} else if ($_POST["confirmar-senha"] != $_POST["senha"]) {
				$msg[3] = "As senhas não são iguais. Verifique por favor.";
				$erro = true;
			}

			if (!$erro) {

				$usuarioDAO = new UsuarioDAO($this->param);

				if ($usuarioDAO->emailJaExiste($_POST["email"])) {
					$msg[1] = "Este e-mail já está cadastrado em nosso sistema.";
					$erro = true;
				} else {
					$senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);
					$usuario = new Usuario(0, $_POST["nome"], $_POST["email"], $senhaCriptografada);

					if ($usuarioDAO->cadastrar($usuario)) {

						$novoUsuario = $usuarioDAO->buscarPorEmail($_POST["email"]);

						if ($novoUsuario) {
							if (!isset($_SESSION)) {
								session_start();
							}
							$_SESSION["id_usuario"] = $novoUsuario->getId();
							$_SESSION["nome_usuario"] = $novoUsuario->getNome();

							header("Location: /crivo/dashboard");
							exit();

						} else {
							header("Location: /crivo/login?msg=cadastro_sucesso");
							exit();
						}

					} else {
						$msg[4] = "Ocorreu um erro inesperado ao salvar. Tente novamente.";
						$erro = true;
					}
				}
			}
		}
		require_once "Views/cadastrar.php";
	}

	public function dashboard()
	{
		require_once "Views/inicioPosLogin.php";
	}

	public function authGoogle()
	{
		if (!isset($_SESSION)) {
			session_start();
		}

		$client = new Google_Client();

		$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
		$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);


		$redirectUri = 'http://localhost/crivo/login/google-callback';
		$client->setRedirectUri($redirectUri);

		$client->addScope("email");
		$client->addScope("profile");

		$authUrl = $client->createAuthUrl();

		header('Location: ' . $authUrl);
		exit();

	}

	public function callbackGoogle()
	{
		if (!isset($_SESSION)) {
			session_start();
		}

		if (isset($_SESSION['google_authenticated']) && $_SESSION['google_authenticated'] === true) {
			header('Location: /crivo/dashboard');
			exit();
		}

		try {

			if (isset($_GET['error'])) {
				header('Location: /crivo/login?erro=google_negado');
				exit();
			}

			if (!isset($_GET['code'])) {
				header('Location: /crivo/login?erro=google_sem_codigo');
				exit();
			}

			$client = new Google_Client();
			$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
			$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
			$redirectUri = 'http://localhost/crivo/login/google-callback';
			$client->setRedirectUri($redirectUri);


			$code = $_GET['code'] ?? null;

			if (!$code) {
				header('Location: /crivo/login?erro=google_codigo_ausente');
				exit();
			}

			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

			if (!is_array($token)) {
				throw new Exception("O Google retornou um valor inesperado para o token.");
			}

			if (isset($token['error'])) {
				throw new Exception("Falha ao obter token: " . $token['error_description'] ?? $token['error']);
			}

			$client->setAccessToken($token);

			$oauth2 = new Google_Service_Oauth2($client);
			$googleUserInfo = $oauth2->userinfo->get();

			$email = $googleUserInfo->email;
			$nome = $googleUserInfo->name;

			$usuarioDAO = new UsuarioDAO($this->param);

			if ($usuarioDAO->emailJaExiste($email)) {

				$usuario = $usuarioDAO->buscarPorEmail($email);

				if ($usuario) {
					$_SESSION["id_usuario"] = $usuario->getId();
					$_SESSION["nome_usuario"] = $usuario->getNome();
					header('Location: /crivo/dashboard');
					exit();
				} else {
					throw new Exception("E-mail existe, mas não foi possível buscar o usuário.");
				}

			} else {
				$senhaAleatoria = bin2hex(random_bytes(32));
				$senhaCriptografada = password_hash($senhaAleatoria, PASSWORD_DEFAULT);

				$novoUsuario = new Usuario(0, $nome, $email, $senhaCriptografada);

				if ($usuarioDAO->cadastrar($novoUsuario)) {
					$usuario = $usuarioDAO->buscarPorEmail($email);

					$_SESSION["id_usuario"] = $usuario->getId();
					$_SESSION["nome_usuario"] = $usuario->getNome();
					header('Location: /crivo/dashboard');
					exit();
				} else {
					throw new Exception("Falha ao cadastrar o novo usuário vindo do Google.");
				}
			}

		} catch (Exception $e) {
			header('Location: /crivo/login?erro=google_exception');
			exit();
		}
	}


}
?>