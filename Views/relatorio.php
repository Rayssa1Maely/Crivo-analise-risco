<?php

$urlParaAnalisar = $analise->getUrlAnalisada();
$nivelRisco = $analise->getResultadoAnalise();
$dataAnalise = $analise->getDataAnalise();

$totalAvaliacoes = is_array($avaliacoes) ? count($avaliacoes) : 0;
$media = 0;
if ($totalAvaliacoes > 0) {
    $soma = 0;
    foreach ($avaliacoes as $av) {
        $soma += $av->getNota();
    }
    $media = $soma / $totalAvaliacoes;
}


if ($nivelRisco == 'Alto') {
    $corTema = 'red';
    $icone = '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>';
    $tituloExplicativo = "Perigo Iminente Detectado";
    $textoExplicativo = "Nossos motores de segurança encontraram múltiplos sinais de alerta vermelho associados a este domínio. Isso geralmente significa que o site está listado em bancos de dados de phishing (roubo de dados), distribuição de malware ou fraudes financeiras comprovadas.";
    $acaoRecomendada = "NÃO INSIRA NENHUM DADO PESSOAL OU DE CARTÃO DE CRÉDITO NESTE SITE. Feche a aba imediatamente.";
} elseif ($nivelRisco == 'Médio') {
    $corTema = 'yellow';
    $icone = '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
    $tituloExplicativo = "Atenção Necessária";
    $textoExplicativo = "O site apresenta algumas características suspeitas. Pode ser um domínio recém-criado (muito comum em golpes temporários), ter um certificado de segurança mal configurado ou possuir relatos mistos na comunidade.";
    $acaoRecomendada = "Prossiga com extrema cautela. Procure por canais oficiais de atendimento, CNPJ no rodapé do site e verifique a reputação em sites como o ReclameAqui antes de comprar.";
} else {
    $corTema = 'green';
    $icone = '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
    $tituloExplicativo = "Ambiente Seguro";
    $textoExplicativo = "Não encontramos nenhum registro malicioso atrelado a este domínio. Ele possui tempo de registro adequado, protocolos de criptografia válidos e não está em nenhuma lista negra global de segurança.";
    $acaoRecomendada = "Você pode navegar e realizar compras com tranquilidade. Ainda assim, sempre verifique se o valor do produto condiz com a realidade do mercado.";
}
?>

<?php require_once "Views/menu_posLogado.php"; ?>

<main class="bg-gray-50 py-12 min-h-screen">
    <div class="container mx-auto px-6 max-w-5xl">
        
        <div class="mb-10 text-center md:text-left flex flex-col md:flex-row justify-between items-center border-b border-gray-200 pb-8">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">Dossiê de Segurança</h1>
                <p class="text-gray-500 font-mono mt-2"><?= htmlspecialchars($urlParaAnalisar) ?></p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Data da Auditoria</p>
                <p class="text-lg font-black text-gray-800"><?= $dataAnalise ?></p>
            </div>
        </div>

        <div class="bg-<?= $corTema ?>-50 border-2 border-<?= $corTema ?>-200 rounded-3xl p-8 md:p-12 shadow-lg mb-12 flex flex-col md:flex-row items-center gap-8">
            <div class="text-<?= $corTema ?>-600 bg-<?= $corTema ?>-100 p-6 rounded-full shadow-inner">
                <?= $icone ?>
            </div>
            <div>
                <h2 class="text-sm font-black text-<?= $corTema ?>-800 uppercase tracking-widest mb-1">Veredito Final</h2>
                <h3 class="text-4xl font-black text-<?= $corTema ?>-900 mb-4">Risco <?= $nivelRisco ?></h3>
                <p class="text-<?= $corTema ?>-800 text-lg font-medium leading-relaxed"><?= $textoExplicativo ?></p>
                <div class="mt-6 inline-block bg-white/60 px-6 py-3 rounded-xl border border-<?= $corTema ?>-200">
                    <span class="font-black text-gray-900">Recomendação Crivo:</span> <span class="text-gray-700"><?= $acaoRecomendada ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-10 shadow-xl border border-gray-100 mb-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-10"></div>
            <h3 class="text-3xl md:text-3xl font-extrabold text-gray-900 leading-tight">Guia Anti-Fraude</h3><br>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="flex gap-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-xl h-fit">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 text-lg">Inspecione a URL</h4>
                        <p class="text-gray-600 text-sm mt-1">Golpistas trocam letras para enganar os olhos (ex: <i>g00gle.com</i> ou <i>americanas-oferta.com</i>). O Crivo analisa isso, mas seu olho clínico é essencial.</p>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-xl h-fit">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-900 text-lg">Milagre não existe</h4>
                        <p class="text-gray-600 text-sm mt-1">Se um smartphone de R$ 5.000 está sendo vendido por R$ 1.500, a chance de fraude beira os 100%. Sites fraudulentos usam a urgência para forçar o pagamento via PIX.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-gray-100 mb-10">
            <div class="p-10 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <div>
                    <h3 class="text-3xl md:text-3xl font-extrabold text-gray-900 leading-tight">Experiências da Comunidade</h3>
                    <p class="text-sm text-gray-500 mt-1">O que outros usuários do Crivo relataram sobre este domínio</p>
                </div>
                <div class="flex items-center px-4 py-3 bg-white rounded-2xl shadow-sm border border-gray-200">
                    <span class="text-3xl font-black text-gray-900 mr-3"><?= number_format($media, 1) ?></span>
                    <div class="flex flex-col">
                        <div class="flex text-yellow-400">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <svg class="h-4 w-4 <?= ($i <= round($media)) ? 'fill-current' : 'text-gray-200 fill-current' ?>" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endfor; ?>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mt-1"><?= $totalAvaliacoes ?> Avaliações</span>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-50">
                <?php if ($totalAvaliacoes > 0): ?>
                    <?php foreach ($avaliacoes as $av): ?>
                        <div class="p-8 hover:bg-gray-50 transition">
                            <div class="flex items-start">
                                <div class="h-10 w-10 rounded-xl bg-gray-900 flex items-center justify-center text-white font-black shadow-md mr-4 shrink-0">
                                    <?= strtoupper(substr($av->getNomeUsuario(), 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <p class="text-sm font-black text-gray-900"><?= htmlspecialchars($av->getNomeUsuario()) ?></p>
                                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full"><?= $av->getDataAvaliacaoFormatada() ?></span>
                                    </div>
                                    <div class="flex text-yellow-400 mb-3">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <svg class="h-3 w-3 <?= ($i <= $av->getNota()) ? 'fill-current' : 'text-gray-200 fill-current' ?>" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed">"<?= nl2br(htmlspecialchars($av->getComentario())) ?>"</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-16 text-center">
                        <p class="text-gray-400 font-bold uppercase text-xs tracking-widest mb-4">O histórico da comunidade está vazio</p>
                        <a href="/crivo/avaliacoes?url=<?= urlencode($urlParaAnalisar) ?>" class="bg-blue-600 text-white font-black text-sm px-6 py-3 rounded-xl hover:bg-blue-700 transition">Seja o primeiro a alertar ou recomendar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="text-center">
            <a href="/crivo/historico" class="inline-flex items-center font-bold text-gray-500 hover:text-gray-900 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Voltar para o Histórico
            </a>
        </div>

    </div>
</main>

<?php require_once "Views/footer.html"; ?>