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

                <div class="mb-4 text-left">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <div><?php echo $msg[0]; ?></div>
                </div>

                <div class="mb-6 text-left">
                    <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="********"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <div><?php echo $msg[1]; ?></div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Entrar na minha conta
                </button>

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