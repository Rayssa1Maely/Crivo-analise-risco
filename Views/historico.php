<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "Views/menu_posLogado.php";
?>

<main>
    <section class="bg-gray-50 py-20 sm:py-24">
        <div class="container mx-auto px-6">
            
            <div class="text-center md:text-left md:flex md:items-center md:justify-between">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Meu Histórico
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Aqui estão todas as análises que você já realizou, <?php echo htmlspecialchars($nome_usuario); ?>.
                </p>
            </div>

            <div class="mt-16 bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    
                    <?php if (empty($historico)): ?>
                        <div class="p-10 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-xl font-semibold text-gray-700">Nenhuma análise encontrada</h3>
                            <p class="mt-2 text-gray-500">Você ainda não analisou nenhum site. Comece agora na página inicial!</p>
                            <a href="/crivo/dashboard" class="mt-6 inline-block px-5 py-3 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">Fazer minha primeira análise</a>
                        </div>

                    <?php else: ?>
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">URL Analisada</th>
                                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Resultado</th>
                                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Data</th>
                                    <th scope="col" class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">

                                <?php foreach ($historico as $analise): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-base font-medium text-gray-900 truncate" style="max-width: 300px;">
                                                <?php echo htmlspecialchars($analise->getUrlAnalisada()); ?>
                                            </div>
                                            <div class="text-sm text-gray-500 lg:hidden">
                                                <?php echo $analise->getDataAnalise(); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 hidden md:table-cell">
                                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                <?php echo htmlspecialchars($analise->getResultadoAnalise()); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 hidden lg:table-cell">
                                            <?php echo $analise->getDataAnalise(); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-800">Ver detalhes</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </section>

    <?php
        require_once "Views/footer.html";
    ?>
</main>