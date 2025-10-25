<div class="container mx-auto max-w-4xl">

    <div class="bg-<?php echo $corRisco; ?>-50 border border-<?php echo $corRisco; ?>-200 rounded-lg p-6 shadow-sm mb-8">
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
                <div class="ml-4">
                    <p class="inline-block px-2.5 py-0.5 mb-2 text-xs font-semibold text-<?php echo $corRisco; ?>-800 bg-<?php echo $corRisco; ?>-100 border border-<?php echo $corRisco; ?>-300 rounded-full">
                        Pontuação de Risco: <?php echo $pontuacao; ?>/100
                    </p>
                    <h2 class="text-lg font-bold text-gray-900">Risco <?php echo $nivelRisco; ?></h2>
                    <p class="text-sm text-gray-600 mt-1">
                        <?php if ($corRisco == 'red'): ?>
                           Detecções significativas encontradas (<?php echo $pontuacaoMaliciosa; ?> maliciosas / <?php echo $pontuacaoSuspeita; ?> suspeitas). Evite este site.
                        <?php elseif ($corRisco == 'yellow'): ?>
                           Algumas preocupações detectadas (<?php echo $pontuacaoSuspeita; ?> suspeitas). Revise os detalhes cuidadosamente.
                        <?php else: ?>
                           Nenhuma ameaça significativa detectada pelos <?php echo $totalMecanismos; ?> mecanismos de segurança.
                        <?php endif; ?>
                    </p>
                    <div class="flex items-center mt-3">
                        <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                        </svg>
                        <p class="text-xs text-gray-500 ml-2 truncate"><?php echo htmlspecialchars($url); ?></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-6 flex-shrink-0 flex flex-col items-start sm:items-end w-full sm:w-auto">
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Ver Relatório Completo (Em breve)
                </button>
                <button class="mt-2 text-xs text-gray-500 hover:underline">Reportar Problema</button>
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

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                <?php if ($temSSL): ?>
                    <svg class="h-6 w-6 text-green-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /> </svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Certificado SSL</p>
                        <p class="text-sm text-gray-600">Criptografia HTTPS válida</p>
                    </div>
                <?php else: ?>
                    <svg class="h-6 w-6 text-red-500 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">Certificado SSL</p>
                        <p class="text-sm text-gray-600">Site NÃO usa HTTPS ou certificado inválido!</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                <svg class="h-6 w-6 text-gray-500 flex-shrink-0" ...>...</svg> <div class="ml-3">
                     <p class="font-semibold text-gray-800">Idade do Domínio</p>
                     <p class="text-sm text-gray-600"><?php echo htmlspecialchars($idadeDominio);                                 ?></p>
                 </div>
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                <?php if ($pontuacaoMaliciosa > 0): ?>
                     <svg class="h-6 w-6 text-red-500 flex-shrink-0" ...>...</svg> <div class="ml-3">
                         <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                         <p class="text-sm text-gray-600"><?php echo $pontuacaoMaliciosa; ?> detecções MALICIOSAS!</p>
                     </div>
                <?php elseif ($pontuacaoSuspeita > 0): ?>
                     <svg class="h-6 w-6 text-yellow-500 flex-shrink-0" ...>...</svg> <div class="ml-3">
                         <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                         <p class="text-sm text-gray-600"><?php echo $pontuacaoSuspeita; ?> detecções SUSPEITAS.</p>
                     </div>
                <?php else: ?>
                    <svg class="h-6 w-6 text-green-500 flex-shrink-0" ...>...</svg> <div class="ml-3">
                        <p class="font-semibold text-gray-800">Banco de Dados de Ameaças</p>
                        <p class="text-sm text-gray-600">Nenhuma ameaça conhecida (<?php echo $totalMecanismos; ?> motores)</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                <svg class="h-6 w-6 text-gray-500 flex-shrink-0" ...>...</svg>
                <div class="ml-3">
                    <p class="font-semibold text-gray-800">Avaliações de Usuários</p>
                    <p class="text-sm text-gray-600">Faça login para ver/adicionar</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-900 mb-8 flex items-center">
            <svg class="h-6 w-6 text-blue-600 mr-3" ...>...</svg>
            Avaliações da Comunidade
        </h3>
        <div class="flex flex-col items-center justify-center py-8">
            <div class="bg-slate-100 p-4 rounded-full mb-4">
                <svg class="h-8 w-8 text-gray-500" ...>...</svg>
            </div>
            <p class="text-gray-600 mb-4">Faça login para ver e adicionar avaliações da comunidade.</p>
            <a href="/crivo/cadastrar" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm">
                Criar Conta Gratuita
            </a>
        </div>
    </div>

</div>