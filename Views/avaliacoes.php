<?php
    
    if (isset($_SESSION['id_usuario'])) {
        require_once "Views/menu_posLogado.php";
    } else {
        require_once "Views/menu.php";
    }
?>

<main>
    <section class="bg-gray-50 py-20 sm:py-24">
        <div class="container mx-auto px-6">

            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Avaliações da Comunidade
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Veja o que outros usuários estão dizendo sobre sites de e-commerce e compartilhe sua experiência para ajudar a todos.
                </p>
            </div>

            <?php if (isset($msg_feedback) && is_array($msg_feedback)):  ?>
                <div class="max-w-4xl mx-auto mb-12 p-4 rounded-lg shadow <?php echo ($msg_feedback['tipo'] === 'sucesso') ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'; ?>">
                    <p><?php echo htmlspecialchars($msg_feedback['texto']); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($usuario_logado): ?>
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg mb-16 border border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        Deixe sua avaliação, <?php echo htmlspecialchars($nome_usuario); ?>!
                    </h2>

                
                    <form action="/crivo/avaliacoes/salvar" method="POST">

                        <div class="mb-5">
                            <label for="url_analisada" class="block text-sm font-medium text-gray-700 mb-2">URL do Site Avaliado *</label>
                            <input type="url" id="url_analisada" name="url_analisada"
                                   placeholder="https://www.siteexemplo.com.br"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                         
                        </div>

                        <div class="mb-6">
                            <label for="comentario" class="block text-sm font-medium text-gray-700 mb-2">Seu Comentário *</label>
                            <textarea id="comentario" name="comentario" rows="5"
                                      placeholder="Descreva sua experiência com o site (positiva ou negativa)..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      required></textarea>
                            
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 -mt-1" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                              <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            Enviar Avaliação
                        </button>
                    </form>
                </div>
            <?php else: ?>
            
                 <div class="max-w-4xl mx-auto bg-blue-50 p-8 rounded-xl border border-blue-200 mb-16 text-center shadow-sm">
                     <svg class="h-12 w-12 text-blue-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.94-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.06 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                     </svg>
                     <h2 class="text-xl font-semibold text-gray-800 mb-3">Participe da conversa!</h2>
                     <p class="text-gray-600 mb-6">Sua opinião é importante. Faça login ou crie uma conta para compartilhar sua experiência e ajudar outros compradores.</p>
                     <a href="/crivo/login" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow-sm mr-3 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 -mt-1" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                         Fazer Login
                     </a>
                     <a href="/crivo/cadastrar" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold py-2 px-5 rounded-lg border border-gray-300 shadow-sm transition duration-150">
                         Criar Conta
                     </a>
                 </div>
            <?php endif; ?>


        
            <div class="max-w-4xl mx-auto space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Últimas Avaliações</h2>

                <?php if (empty($avaliacoes)):?>
                    <div class="text-center py-10 px-6 bg-white rounded-lg shadow border border-gray-100">
                        <svg class="h-12 w-12 text-gray-400 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-3.04 8.25-7.5 8.25S6 16.556 6 12s3.04-8.25 7.5-8.25 7.5 3.694 7.5 8.25z" />
                        </svg>
                        <p class="text-gray-500">Ainda não há avaliações registradas no sistema.</p>
                        <?php if($usuario_logado): ?>
                             <p class="text-gray-500 mt-2">Seja o primeiro a compartilhar sua experiência usando o formulário acima!</p>
                        <?php else: ?>
                             <p class="text-gray-500 mt-2">Faça login para adicionar a primeira avaliação.</p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php foreach ($avaliacoes as $avaliacao): ?>
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 relative">
                             
                             <div class="absolute top-3 right-3 bg-gray-100 px-2 py-0.5 rounded text-xs text-gray-600 flex items-center max-w-[200px] sm:max-w-[300px]" title="<?php echo htmlspecialchars($avaliacao->getUrlAnalisada()); ?>">
                                  <svg class="h-3 w-3 mr-1 text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                  </svg>
                                  <a href="<?php echo htmlspecialchars($avaliacao->getUrlAnalisada()); ?>" target="_blank" rel="noopener noreferrer" class="truncate text-blue-600 hover:underline">
                                      <?php echo htmlspecialchars(parse_url($avaliacao->getUrlAnalisada(), PHP_URL_HOST) ?: $avaliacao->getUrlAnalisada());  ?>
                                  </a>
                             </div>

                            <div class="flex items-start mb-4">
                            
                                <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-200 mr-3 flex-shrink-0">
                                    <svg class="h-full w-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($avaliacao->getNomeUsuario()); ?></p>
                                    <p class="text-xs text-gray-500">em <?php echo $avaliacao->getDataAvaliacaoFormatada();?></p>
                                </div>
                            </div>

                            <p class="text-gray-700 leading-relaxed">
                               <?php echo nl2br(htmlspecialchars($avaliacao->getComentario())); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>
</main>

<?php
    require_once "Views/footer.html";
?>
