<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Menu de Navegação - Logado</title>
</head>

<body class="bg-gray-50">

    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">

                <!-- Logo -->
                <div>
                    <a href="#" class="text-xl font-bold text-gray-800">
                        CRIVO
                    </a>
                </div>

                <!-- Links de Navegação Principais -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Caracteristicas</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Como funciona</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Sobre</a>
                </div>

                <!-- Ações do Usuário Logado com Dropdown -->
                <div class="relative">
                    <!-- Botão que aciona o dropdown -->
                    <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                        <span class="font-semibold text-gray-600">Minha Conta</span>
                        <!-- Ícone de seta para baixo -->
                        <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Painel do Dropdown (escondido por padrão) -->
                    <div id="user-menu"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
                        <a href="/crivo/historico" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Meu
                            Histórico</a>
                        <a href="/crivo/avaliacoes"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Avaliações</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="/crivo/logout"
                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Sair</a>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    <script>
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', (event) => {
            event.stopPropagation();
            userMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', () => {
            if (!userMenu.classList.contains('hidden')) {
                userMenu.classList.add('hidden');
            }
        });
    </script>

</body>

