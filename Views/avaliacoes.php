<?php
    require_once "Views/menu_posLogado.php";
?>

<main>
    <section class="bg-gray-50 py-20 sm:py-24">
        <div class="container mx-auto px-6">
            
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Avaliações da Comunidade
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Veja o que outros usuários estão dizendo e compartilhe sua experiência.
                </p>
            </div>

            <?php if (isset($msg)): ?>
                <div class="max-w-4xl mx-auto mb-8 p-4 rounded-lg <?php echo ($msg['tipo'] === 'sucesso') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?php echo htmlspecialchars($msg['texto']); ?>
                </div>
            <?php endif; ?>

            <?php if ($usuario_logado): ?>
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg mb-16">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Deixe sua avaliação, <?php echo htmlspecialchars(explode(' ', $nome_usuario)[0]); ?>!</h2>
                    
                    <form action="/crivo/avaliacoes" method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Sua nota:</label>
                            <div class="flex flex-row-reverse justify-end items-center" id="star-rating">
                                <input type="radio" id="star5" name="nota" value="5" class="hidden peer" /><label for="star5" class="text-3xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer transition-colors">&#9733;</label>
                                <input type="radio" id="star4" name="nota" value="4" class="hidden peer" /><label for="star4" class="text-3xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer transition-colors">&#9733;</label>
                                <input type="radio" id="star3" name="nota" value="3" class="hidden peer" /><label for="star3" class="text-3xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer transition-colors">&#9733;</label>
                                <input type="radio" id="star2" name="nota" value="2" class="hidden peer" /><label for="star2" class="text-3xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer transition-colors">&#9733;</label>
                                <input type="radio" id="star1" name="nota" value="1" class="hidden peer" /><label for="star1" class="text-3xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 cursor-pointer transition-colors">&#9733;</label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="comentario" class="block text-gray-700 font-medium mb-2">Seu comentário:</label>
                            <textarea id="comentario" name="comentario" rows="4"
                                class="w-full px-4 py-3 text-base text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Descreva sua experiência com o Crivo..."></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Enviar Avaliação
                            </button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="max-w-4xl mx-auto text-center bg-white p-8 rounded-xl shadow-lg mb-16">
                    <p class="text-lg text-gray-700">
                        Você precisa estar logado para deixar uma avaliação.
                        <a href="/crivo/login" class="text-blue-600 font-semibold hover:underline">Faça login</a> ou 
                        <a href="/crivo/cadastrar" class="text-blue-600 font-semibold hover:underline">cadastre-se</a>.
                    </p>
                </div>
            <?php endif; ?>


            <div class="max-w-4xl mx-auto space-y-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center sm:text-left">O que estão dizendo</h2>

                <?php if (empty($avaliacoes)): ?>
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <p class="text-gray-600">Ainda não há nenhuma avaliação. Seja o primeiro a deixar a sua!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($avaliacoes as $avaliacao): ?>
                        <article class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($avaliacao->getNomeUsuario()); ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo $avaliacao->getDataAvaliacao(); ?></p>
                                </div>
                                <div class="flex items-center">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <svg class="h-5 w-5 <?php echo ($i < $avaliacao->getNota()) ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.286 3.957c.3.921-.755 1.688-1.538 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.783.57-1.838-.197-1.538-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.07 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                <?php echo nl2br(htmlspecialchars($avaliacao->getComentario())); ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <?php
        require_once "Views/footer.html";
    ?>
</main>
