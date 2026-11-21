<?php
require_once 'conexao.php';

$destaques = $pdo->query("SELECT * FROM produtos WHERE secao = 'destaque' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$maisVendidos = $pdo->query("SELECT * FROM produtos WHERE secao = 'mais_vendido' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopFacil - Sua Loja Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- 1. Cabeçalho -->
    <header class="cabecalho">
        <div class="container cabecalho-flex">
            <a href="index.php" class="logo">Shop<span>Facil</span></a>

            <div class="barra-busca">
                <input type="text" id="campoBusca" placeholder="Buscar produtos, marcas e mais...">
                <button type="button" id="btnBuscar">Buscar</button>
            </div>

            <div class="acoes-topo">
                <a href="admin.php" class="link-conta">Painel Admin</a>
                <button type="button" class="btn-carrinho" id="btnCarrinho">
                    Carrinho (<span id="contadorCarrinho">0</span>)
                </button>
                <button type="button" class="btn-mobile" id="btnMenuMobile">☰</button>
            </div>
        </div>
    </header>

    <!-- 2. Barra de Navegação -->
    <nav class="barra-nav" id="menuPrincipal">
        <div class="container">
            <ul class="nav-lista">
                <li><a href="index.php" class="ativo">Início</a></li>
                <li><a href="#categorias">Categorias</a></li>
                <li><a href="#destaques">Destaques</a></li>
                <li><a href="#mais-vendidos">Mais Vendidos</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <!-- 3. Seção Hero -->
        <section class="hero container">
            <div class="hero-texto">
                <span class="etiqueta">NOVIDADES</span>
                <h1>Os Melhores Produtos para o Seu Dia a Dia</h1>
                <p>Até 40% de desconto em eletrônicos, moda e itens para sua casa com entrega rápida.</p>
                <a href="#destaques" class="btn-escuro">Comprar Agora →</a>
            </div>
            <div class="hero-destaque">
                <h3>Ofertas da Semana</h3>
                <p>Parcele em até 10x sem juros ou ganhe 10% OFF no Pix.</p>
            </div>
        </section>

        <!-- 4. Seção de Categorias -->
        <section class="secao container" id="categorias">
            <div class="topo-secao">
                <h2>Categorias</h2>
            </div>
            <div class="grade-categorias">
                <button class="cat-item ativo" data-categoria="todos">
                    <span class="cat-icone">★</span>
                    <span>Todos</span>
                </button>
                <button class="cat-item" data-categoria="Eletrônicos">
                    <span class="cat-icone">💻</span>
                    <span>Eletrônicos</span>
                </button>
                <button class="cat-item" data-categoria="Moda">
                    <span class="cat-icone">👕</span>
                    <span>Moda</span>
                </button>
                <button class="cat-item" data-categoria="Casa & Cozinha">
                    <span class="cat-icone">🏠</span>
                    <span>Casa & Cozinha</span>
                </button>
                <button class="cat-item" data-categoria="Beleza">
                    <span class="cat-icone">✨</span>
                    <span>Beleza</span>
                </button>
                <button class="cat-item" data-categoria="Esportes">
                    <span class="cat-icone">⚽</span>
                    <span>Esportes</span>
                </button>
                <button class="cat-item" data-categoria="Livros">
                    <span class="cat-icone">📚</span>
                    <span>Livros</span>
                </button>
            </div>
        </section>

        <!-- 5. Produtos em Destaque -->
        <section class="secao container" id="destaques">
            <div class="topo-secao">
                <h2>Produtos em Destaque</h2>
                <a href="admin.php" class="ver-todos">Gerenciar →</a>
            </div>
            <div class="grade-produtos">
                <?php foreach ($destaques as $item) { ?>
                    <article class="card-produto" data-categoria="<?php echo $item['categoria']; ?>" data-nome="<?php echo strtolower($item['nome']); ?>">
                        <div class="produto-foto">
                            <?php if (!empty($item['imagem']) && file_exists($item['imagem'])) { ?>
                                <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>">
                            <?php } else { ?>
                                <div class="sem-foto"><?php echo $item['categoria']; ?></div>
                            <?php } ?>
                        </div>
                        <span class="cat-label"><?php echo $item['categoria']; ?></span>
                        <h3><?php echo $item['nome']; ?></h3>
                        <p class="estrelas">★★★★★ <span>(4.8)</span></p>
                        <div class="card-rodape">
                            <strong class="preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></strong>
                            <button type="button" class="btn-add" data-nome="<?php echo $item['nome']; ?>">+ Carrinho</button>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>

        <!-- 6. Banners Promocionais -->
        <section class="secao container banners-promo">
            <div class="banner-card banner-laranja">
                <span class="etiqueta-banner">TEMPO LIMITADO</span>
                <h3>Até 50% OFF</h3>
                <p>Na coleção de Moda e Acessórios.</p>
                <a href="#mais-vendidos" class="btn-escuro">Ver Moda →</a>
            </div>
            <div class="banner-card banner-azul">
                <span class="etiqueta-banner">MELHORES OFERTAS</span>
                <h3>Casa & Cozinha</h3>
                <p>Eletroportáteis e utensílios com até 40% OFF.</p>
                <a href="#mais-vendidos" class="btn-escuro">Ver Ofertas →</a>
            </div>
        </section>

        <!-- 7. Produtos Mais Vendidos -->
        <section class="secao container" id="mais-vendidos">
            <div class="topo-secao">
                <h2>Produtos Mais Vendidos</h2>
                <a href="admin.php" class="ver-todos">Adicionar Novo →</a>
            </div>
            <div class="grade-produtos">
                <?php foreach ($maisVendidos as $item) { ?>
                    <article class="card-produto" data-categoria="<?php echo $item['categoria']; ?>" data-nome="<?php echo strtolower($item['nome']); ?>">
                        <div class="produto-foto">
                            <?php if (!empty($item['imagem']) && file_exists($item['imagem'])) { ?>
                                <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>">
                            <?php } else { ?>
                                <div class="sem-foto"><?php echo $item['categoria']; ?></div>
                            <?php } ?>
                        </div>
                        <span class="cat-label"><?php echo $item['categoria']; ?></span>
                        <h3><?php echo $item['nome']; ?></h3>
                        <p class="estrelas">★★★★★ <span>(4.9)</span></p>
                        <div class="card-rodape">
                            <strong class="preco">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></strong>
                            <button type="button" class="btn-add" data-nome="<?php echo $item['nome']; ?>">+ Carrinho</button>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>

        <!-- 8. Diferenciais -->
        <section class="diferenciais">
            <div class="container grade-diferenciais">
                <div class="dif-item">
                    <h4>Frete Grátis</h4>
                    <p>Em pedidos acima de R$ 199</p>
                </div>
                <div class="dif-item">
                    <h4>Pagamento Seguro</h4>
                    <p>Checkout 100% protegido</p>
                </div>
                <div class="dif-item">
                    <h4>Troca Fácil</h4>
                    <p>Até 7 dias para devolução</p>
                </div>
                <div class="dif-item">
                    <h4>Suporte 24/7</h4>
                    <p>Atendimento ao cliente dedicado</p>
                </div>
            </div>
        </section>

        <!-- 9. Newsletter -->
        <section class="newsletter container">
            <div class="newsletter-box">
                <div>
                    <h3>Receba as Últimas Novidades</h3>
                    <p>Cadastre seu e-mail para receber ofertas exclusivas e lançamentos.</p>
                </div>
                <form id="formNewsletter" class="form-news" novalidate>
                    <input type="email" id="emailNews" placeholder="Digite seu e-mail">
                    <button type="submit">Inscrever</button>
                </form>
                <p id="msgNews" class="msg-retorno"></p>
            </div>
        </section>
    </main>

    <!-- 10. Rodapé -->
    <footer class="rodape">
        <div class="container rodape-grid">
            <div>
                <h4>ShopFacil</h4>
                <p>Sua loja completa para tudo o que você precisa no dia a dia.</p>
            </div>
            <div>
                <h4>Loja</h4>
                <ul>
                    <li><a href="index.php#destaques">Destaques</a></li>
                    <li><a href="index.php#mais-vendidos">Mais Vendidos</a></li>
                    <li><a href="admin.php">Painel CRUD</a></li>
                </ul>
            </div>
            <div>
                <h4>Atendimento</h4>
                <ul>
                    <li><a href="contato.php">Fale Conosco</a></li>
                    <li><a href="contato.php">Trocas e Devoluções</a></li>
                    <li><a href="contato.php">Dúvidas Frequentes</a></li>
                </ul>
            </div>
            <div>
                <h4>Pagamento</h4>
                <p>Cartão de Crédito, Pix e Boleto</p>
            </div>
        </div>
        <div class="rodape-base">
            <p>&copy; 2026 ShopFacil - Trabalho de Desenvolvimento Web</p>
        </div>
    </footer>

    <div id="toastAviso" class="toast"></div>
    <script src="js/script.js"></script>
</body>
</html>