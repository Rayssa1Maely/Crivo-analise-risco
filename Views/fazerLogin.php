<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="bg-gray-50 text-gray-800">

    <main class="flex items-center justify-center py-20 px-4">
        <div class="w-full max-w-md text-center">

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                Acessar sua Conta
            </h1>

            <p class="mt-4 text-lg text-gray-600">
                Bem-vindo de volta! Continue sua busca por um e-commerce mais seguro.
            </p>

            <form action="/crivo/login" method="POST" class="mt-8">

                <?php if (!empty($msg[2])) {
                    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6' role='alert'><span>";
                    echo $msg[2];
                    echo "</span></div>";
                } ?>

                <div class="mb-4 text-left">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 <?php echo (!empty($msg[0]) || !empty($msg[2])) ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'; ?>"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <div class="text-red-600 text-sm mt-1"><?php echo $msg[0]; ?>
                </div>
        </div>

        <div class="mb-6 text-left">
            <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="********"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 <?php echo (!empty($msg[1]) || !empty($msg[2])) ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-blue-500'; ?>">
            <div class="text-red-600 text-sm mt-1"><?php echo $msg[1]; ?></div>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
            Entrar na minha conta
        </button>

        <div class="my-6 flex items-center justify-center">
            <span class="border-t border-gray-300 flex-grow"></span>
            <span class="px-4 text-gray-500">ou</span>
            <span class="border-t border-gray-300 flex-grow"></span>
        </div>

        <a href="/crivo/login/google"
            class="w-full flex items-center justify-center bg-white border border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-50 transition duration-300">

            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                <path fill="#EA4335"
                    d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z">
                </path>
                <path fill="#4285F4"
                    d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v8.51h12.8c-.57 2.73-2.21 5.03-4.64 6.58l7.6 5.86C43.34 36.32 46.98 31 46.98 24.55z">
                </path>
                <path fill="#FBBC05"
                    d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z">
                </path>
                <path fill="#34A853"
                    d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.6-5.86c-2.15 1.45-4.92 2.3-8.29 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z">
                </path>
                <path fill="none" d="M0 0h48v48H0z"></path>
            </svg>
            Entrar com Google
        </a>

        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600">
                Ainda não tem uma conta?
                <a href="/crivo/cadastrar" class="text-blue-600 hover:underline font-semibold">Crie uma agora</a>
            </p>
        </div>

        </div>
    </main>

</body>

</html>