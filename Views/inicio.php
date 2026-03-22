<?php
require_once "Views/menu.php";
?>
<main>

    <section class="bg-gray-50 py-20 sm:py-24">
        <div class="container mx-auto px-6 text-center">

            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">Compre online com confiança</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Analise instantaneamente sites de comércio eletrônico em busca de riscos de segurança, golpes e reputação. Proteja-se contra fraudes online com inteligência de ameaças em tempo real.</p>

            <div class="mt-10 max-w-xl mx-auto">
                <div class="flex flex-col space-y-4">
                    <input id="url-input" type="text" placeholder="Insira a URL do e-commerce para analisar (e.g., example-shop.com)" class="w-full px-5 py-4 text-base text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button id="analyze-button" class="flex items-center justify-center w-full px-5 py-4 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Analisar a segurança do site
                    </button>

                    <div id="loading-indicator" class="hidden">
                        <div class="flex items-center justify-center text-blue-600 font-semibold mt-2">
                            <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Analisando...
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-center text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verificaremos o site em bancos de dados de ameaças conhecidas, verificaremos certificados SSL e analisaremos a reputação do domínio.
            </div>
        </div>
    </section>

    <section id="resultado-analise" class="container mx-auto px-6 py-10"></section>
    <?php
    if (isset($url)) {
        require_once "resultado.php";
    }
    ?>

    <section class="bg-white py-20 sm:py-24">
        <div class="container mx-auto px-6 text-center">

            <h2 id="funciona" class="text-3xl md:text-4xl font-bold text-gray-900">Como funciona</h2>
            <p class="mt-3 text-lg text-gray-600">Obtenha seu relatório de segurança em segundos</p>

            <div class="mt-16 grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-600 text-white font-bold text-2xl rounded-full">1</div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">Digite a URL</h3>
                    <p class="mt-2 text-gray-600">Cole a URL do site de comércio eletrônico que você deseja verificar</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-600 text-white font-bold text-2xl rounded-full">2</div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">Analise instantânea</h3>
                    <p class="mt-2 text-gray-600">Nosso sistema verifica vários bancos de dados e indicadores de segurança</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-600 text-white font-bold text-2xl rounded-full">3</div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">Obtenha resultados</h3>
                    <p class="mt-2 text-gray-600">Receba uma avaliação de risco detalhada e recomendações de segurança</p>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-gray-50 py-20 sm:py-24">
        <div class="container mx-auto px-6 text-center">

            <h2 id="caracteristica" class="text-3xl md:text-4xl font-bold text-gray-900">Análise de Segurança Abrangente</h2>
            <p class="mt-3 text-lg text-gray-600">Várias camadas de proteção para mantê-lo seguro enquanto faz compras online</p>

            <div class="mt-16 grid md:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">Analises em tempo real</h3>
                    <p class="mt-2 text-gray-600">Verificações de segurança instantâneas em bancos de dados de ameaças globais e listas negras</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-50 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">SSL e verificação de segurança</h3>
                    <p class="mt-2 text-gray-600">Verifique certificados de criptografia e protocolos de conexão segura</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-orange-50 text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-gray-800">Avaliações da comunidade</h3>
                    <p class="mt-2 text-gray-600">Feedback e classificações de usuários reais para criar perfis de reputação abrangentes</p>
                </div>
            </div>
        </div>
    </section>

    <section id="sobre" class="bg-white py-24">
        <div class="container mx-auto px-6">

            <div class="grid md:grid-cols-2 items-center gap-16 mb-24">
                <div class="order-2 md:order-1">
                    <span class="text-blue-600 font-semibold tracking-wide uppercase text-sm">Nossa Essência</span>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Missão</h3>
                    <div class="w-16 h-1 bg-blue-600 mt-4 mb-6"></div>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        O Crivo nasceu da necessidade de tornar o ambiente digital um lugar mais seguro para todos.
                        Em um cenário onde o e-commerce cresce exponencialmente, nossa missão é empoderar o consumidor
                        com informações técnicas e confiáveis antes de cada clique no botão 'comprar'.
                    </p>
                </div>
                <div class="order-1 md:order-2 flex justify-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-blue-100 rounded-full blur-2xl opacity-50"></div>
                        <img src="/crivo/public/img/missao.png" alt="Missão Crivo" class="relative w-full max-w-sm h-auto transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 items-center gap-16">
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-indigo-100 rounded-full blur-2xl opacity-50"></div>
                        <img src="/crivo/public/img/duvida.png" alt="O que fazemos" class="relative w-full max-w-sm h-auto transform  hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                <div>
                    <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">Inovação</span>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">O que fazemos?</h3>
                    <div class="w-16 h-1 bg-indigo-600 mt-4 mb-6"></div>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Desenvolvemos uma ferramenta inteligente que analisa camadas críticas de segurança.
                        Através da integração com APIs globais (VirusTotal, WhoisXML), entregamos um índice de confiança
                        simplificado, protegendo você de golpes e malwares em tempo real.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-24">
        <div class="container mx-auto px-6">
            <div class="text-left mb-16">
                <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">Valores</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Nossos Pilares</h2>
                <div class="w-16 h-1 bg-indigo-600 mt-4 mb-6"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="flex items-start p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="bg-blue-600 p-3 rounded-lg mr-4 shrink-0 shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-lg">Transparência</h4>
                        <p class="text-gray-700 text-sm mt-1">
                            Dados auditáveis de registros mundiais.
                        </p>
                    </div>
                </div>

                <div class="flex items-start p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="bg-green-600 p-3 rounded-lg mr-4 shrink-0 shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-lg">Agilidade</h4>
                        <p class="text-gray-700 text-sm mt-1">
                            Análises complexas em segundos.
                        </p>
                    </div>
                </div>

                <div class="flex items-start p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="bg-orange-600 p-3 rounded-lg mr-4 shrink-0 shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-lg">Comunidade</h4>
                        <p class="text-gray-700 text-sm mt-1">
                            Feedback real de usuários.
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </section>


    <script src="/crivo/public/analise.js"></script>
</main>

<?php
require_once "Views/footer.html";
?>