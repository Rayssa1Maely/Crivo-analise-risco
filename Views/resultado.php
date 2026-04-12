<?php
$totalAvaliacoes = is_array($avaliacoes) ? count($avaliacoes) : 0;
$media = 0;

if ($totalAvaliacoes > 0) {
    $soma = 0;
    foreach ($avaliacoes as $av) {
        $soma += $av->getNota();
    }
    $media = $soma / $totalAvaliacoes;
}

?>

<div class="container mx-auto max-w-4xl">

    <div class="bg-<?php


                    echo $corRisco; ?>-50 border border-<?php echo $corRisco; ?>-200 rounded-lg p-6 shadow-sm mb-8">
        <div class="flex flex-col sm:flex-row items-start justify-between">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <?php if ($corRisco == 'red'): ?>
                        <svg class="h-10 w-10 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 9.75a9 9 0 110-18 9 9 0 010 18zm0-4.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                        </svg>
                    <?php elseif ($corRisco == 'yellow'): ?>
                        <svg class="h-10 w-10 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" />
                        </svg>
                    <?php else: ?>
                        <svg class="h-10 w-10 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" />
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="ml-4 w-full overflow-hidden">
                    <p class="inline-block px-2.5 py-0.5 mb-2 text-xs font-semibold text-<?php echo $corRisco; ?>-800 bg-<?php echo $corRisco; ?>-100 border border-<?php echo $corRisco; ?>-300 rounded-full">
                        Índice de segurança: <?php echo $pontuacao; ?>/100
                    </p>
                    <h2 class="text-lg font-bold text-gray-900 leading-tight">Site de Risco <?php echo $nivelRisco; ?></h2>
                    <p class="text-sm text-gray-600 mt-1">
                        <?php if ($corRisco == 'red'): ?>
                            Detecções significativas encontradas (<?php echo $pontuacaoMaliciosa; ?> maliciosas / <?php echo $pontuacaoSuspeita; ?> suspeitas). Evite este site.
                        <?php elseif ($corRisco == 'yellow'): ?>
                            Algumas preocupações detectadas (<?php echo $pontuacaoSuspeita; ?> suspeitas). Revise os detalhes cuidadosamente.
                        <?php else: ?>
                            Nenhuma ameaça significativa detectada pelos mecanismos de segurança.
                        <?php endif; ?>
                    </p>
                    <div class="flex items-center mt-3">
                        <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                        </svg>
                        <p class="text-xs text-gray-500 ml-2 break-all"><?php echo htmlspecialchars($urlParaAnalisar); ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-6 flex-shrink-0 flex flex-col items-start sm:items-end w-full sm:w-auto">
                <?php if (isset($idAnaliseRecente) && $idAnaliseRecente): ?>
                    <a href="/crivo/relatorio?id=<?php echo $idAnaliseRecente; ?>">
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none">
                            Ver Relatório Completo
                        </button>
                    </a>
                <?php else: ?>
                    <p class="text-xs text-gray-500">Faz login para ver o relatório completo</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
            <svg class="h-6 w-6 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" />
            </svg>
            Verificações de Segurança
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border <?php echo ($temSSL && strpos($urlParaAnalisar, 'https://') === 0) ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'; ?>">
                <?php if ($temSSL && strpos($urlParaAnalisar, 'https://') === 0): ?>
                    <svg class="h-6 w-6 text-green-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Certificado SSL</p>
                        <p class="text-sm text-gray-600">Criptografia HTTPS válida</p>
                    </div>
                <?php else: ?>
                    <svg class="h-6 w-6 text-red-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>

                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Certificado SSL</p>
                        <p class="text-sm text-gray-600">Site NÃO usa HTTPS ou certificado inválido!</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php $dominioNovo = (strpos($idadeDominio, 'dia') !== false || strpos($idadeDominio, 'mês') !== false); ?>

            <div class="flex items-start p-4 rounded-lg border <?php echo ($mesesIdade === null || $dominioNovo) ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200'; ?>">
                <?php if ($mesesIdade === null || $dominioNovo): ?>
                    <svg class="h-6 w-6 text-yellow-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                <?php else: ?>
                    <svg class="h-6 w-6 text-green-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>

                <div class="ml-3">
                    <p class="font-semibold text-gray-800">Idade do Domínio</p>
                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($idadeDominio); ?></p>
                </div>
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border <?php echo ($pontuacaoMaliciosa > 0) ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200'; ?>">
                <?php if ($pontuacaoMaliciosa > 0): ?>
                    <svg class="h-6 w-6 text-red-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                        <p class="text-sm text-gray-600"><?php echo $pontuacaoMaliciosa; ?> detecções MALICIOSAS!</p>
                    </div>
                <?php elseif ($pontuacaoSuspeita > 0): ?>
                    <svg class="h-6 w-6 text-yellow-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                        <p class="text-sm text-gray-600"><?php echo $pontuacaoSuspeita; ?> detecções SUSPEITAS.</p>
                    </div>
                <?php else: ?>
                    <svg class="h-6 w-6 text-green-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                        <p class="text-sm text-gray-600">Nenhuma ameaça conhecida (<?php echo $totalMecanismos; ?> motores)</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex items-start p-4 rounded-lg border <?php echo ($media < 3 && $totalAvaliacoes > 0) ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200'; ?>">
                <svg class="h-6 w-6 <?php echo ($media < 3 && $totalAvaliacoes > 0) ? 'text-yellow-500' : 'text-green-500'; ?> flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <div class="ml-3">
                    <p class="font-semibold text-gray-800 text-base">Reputação da Comunidade</p>
                    <p class="text-sm text-gray-600">
                        <?php
                        if ($totalAvaliacoes == 0) echo "Sem avaliações ainda.";
                        else echo "Média: " . number_format($media, 1) . " / 5.0 (" . $totalAvaliacoes . " avaliações)";
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900 mb-8 flex items-center border-b pb-3">
            <svg class="h-6 w-6 text-blue-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            Avaliações da Comunidade
        </h3>

        <a href="/crivo/avaliacoes?url=<?= urlencode($urlParaAnalisar) ?>"
            class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Avaliar este site
        </a>

        <?php if (!isset($_SESSION['id_usuario'])): ?>
            <div class='flex flex-col items-center justify-center py-8'>
                <div class='bg-slate-100 p-4 rounded-full mb-4'>
                    <svg class='h-8 w-8 text-gray-500' fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <p class='text-gray-600 mb-4'>Faça login para ver e adicionar avaliações da comunidade.</p>
                <a href='/crivo/cadastrar' class='bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm'>
                    Criar Conta Gratuita
                </a>
            </div>
        <?php elseif (empty($avaliacoes)): ?>
            <p class="text-gray-500 py-8 text-center">Nenhuma avaliação encontrada para este site.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comentário</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($avaliacoes as $av): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($av->getNomeUsuario()) ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?= nl2br(htmlspecialchars($av->getComentario())) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex text-yellow-400">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <svg class="h-4 w-4 <?= ($i <= $av->getNota()) ? 'fill-current' : 'text-gray-300 fill-current' ?>" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>
</div>