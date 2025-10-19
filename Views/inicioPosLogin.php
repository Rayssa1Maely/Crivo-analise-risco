<?php
    require_once "Views/menu_posLogado.php";
?>

    <main>
        <section class="bg-gray-50 py-20 sm:py-24">
            <div class="container mx-auto px-6 text-center">

                
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">Olá, [Nome do Usuário]!</h1>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Pronto para analisar um novo site ou revisitar
                    seu histórico?</p>

               
                <div class="mt-10 max-w-xl mx-auto">
                    <div class="flex flex-col space-y-4">
                        <input id="url-input" type="text" placeholder="Insira a URL do e-commerce para analisar..."
                            class="w-full px-5 py-4 text-base text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button id="analyze-button"
                            class="flex items-center justify-center w-full px-5 py-4 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Analisar Segurança
                        </button>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="bg-white py-20 sm:py-24">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center">Seu Painel</h2>
                <p class="mt-3 text-lg text-gray-600 text-center">Acesse rapidamente seus recursos exclusivos.</p>

                <div class="mt-16 grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    
                    <a href="/crivo/historico"
                        class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 block">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-2xl font-semibold text-gray-800">Meu Histórico</h3>
                        </div>
                        <p class="mt-4 text-gray-600">Reveja todas as análises que você já fez e consulte os resultados
                            a qualquer momento.</p>
                    </a>
                    
                    <a href="/crivo/avaliacoes"
                        class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 block">
                        <div class="flex items-center">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-lg bg-orange-50 text-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-2xl font-semibold text-gray-800">Avaliações da Comunidade</h3>
                        </div>
                        <p class="mt-4 text-gray-600">Leia e compartilhe experiências com outros usuários para tomar
                            decisões ainda mais seguras.</p>
                    </a>
                </div>
            </div>
        </section>

        <?php
            require_once "Views/footer.html";
        ?>
    </main>

</body>

</html>