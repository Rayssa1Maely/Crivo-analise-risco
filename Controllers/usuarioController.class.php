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
                    if (session_status() === PHP_SESSION_NONE) session_start();
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
            if (empty($_POST["nome"])) { $msg[0] = "Preencha o nome"; $erro = true; }
            if (empty($_POST["email"])) { $msg[1] = "Preencha o email"; $erro = true; }
            if (empty($_POST["senha"])) { $msg[2] = "Preencha a senha"; $erro = true; }
            if (!$erro) {
                $usuarioDAO = new UsuarioDAO($this->param);
                if ($usuarioDAO->emailJaExiste($_POST["email"])) {
                    $msg[1] = "E-mail já cadastrado.";
                    $erro = true;
                } else {
                    $senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);
                    $usuario = new Usuario(0, $_POST["nome"], $_POST["email"], $senhaCriptografada);
                    if ($usuarioDAO->cadastrar($usuario)) {
                        header("Location: /crivo/login?msg=cadastro_sucesso");
                        exit();
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
        $clientId = $_ENV['GOOGLE_CLIENT_ID'];
        $redirectUri = 'http://localhost/crivo/login/google-callback';
        $authUrl = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'online'
        ]);
        header('Location: ' . $authUrl);
        exit();
    }

    public function callbackGoogle()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $code = $_GET['code'] ?? null;
        if (!$code) {
            header('Location: /crivo/login?erro=google_sem_codigo');
            exit();
        }

        try {
            $ch = curl_init('https://oauth2.googleapis.com/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'code' => $code,
                'client_id' => $_ENV['GOOGLE_CLIENT_ID'],
                'client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'],
                'redirect_uri' => 'http://localhost/crivo/login/google-callback',
                'grant_type' => 'authorization_code'
            ]));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $token = json_decode($response, true);
            curl_close($ch);

            if (!isset($token['access_token'])) {
                throw new Exception("Falha ao obter token do Google.");
            }

            $ch = curl_init('https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . $token['access_token']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $userResponse = curl_exec($ch);
            $googleUserInfo = json_decode($userResponse, true);
            curl_close($ch);

            $email = $googleUserInfo['email'];
            $nome = $googleUserInfo['name'];

            $usuarioDAO = new UsuarioDAO($this->param);
            $usuario = $usuarioDAO->buscarPorEmail($email);

            if (!$usuario) {
                $senhaAleatoria = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);
                $novoUsuario = new Usuario(0, $nome, $email, $senhaAleatoria);
                $usuarioDAO->cadastrar($novoUsuario);
                $usuario = $usuarioDAO->buscarPorEmail($email);
            }

            $_SESSION["id_usuario"] = $usuario->getId();
            $_SESSION["nome_usuario"] = $usuario->getNome();
            header('Location: /crivo/dashboard');
            exit();

        } catch (Exception $e) {
            header('Location: /crivo/login?erro=google_exception');
            exit();
        }
    }
}