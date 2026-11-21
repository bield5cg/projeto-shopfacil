<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - ShopFacil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecalho">
        <div class="container cabecalho-flex">
            <a href="index.php" class="logo">Shop<span>Facil</span></a>
            <div class="acoes-topo">
                <a href="admin.php" class="link-conta">Painel Admin</a>
                <button type="button" class="btn-mobile" id="btnMenuMobile">☰</button>
            </div>
        </div>
    </header>

    <nav class="barra-nav" id="menuPrincipal">
        <div class="container">
            <ul class="nav-lista">
                <li><a href="index.php">Início</a></li>
                <li><a href="index.php#destaques">Destaques</a></li>
                <li><a href="contato.php" class="ativo">Contato</a></li>
            </ul>
        </div>
    </nav>

    <main class="container secao-interna">
        <h1>Fale Conosco</h1>
        <p class="subtitulo">Envie sua dúvida, sugestão ou solicitação de suporte.</p>

        <form id="formContato" class="box-form" novalidate>
            <div class="campo">
                <label for="nomeContato">Nome completo</label>
                <input type="text" id="nomeContato" placeholder="Seu nome">
            </div>
            <div class="campo">
                <label for="emailContato">E-mail</label>
                <input type="email" id="emailContato" placeholder="seuemail@exemplo.com">
            </div>
            <div class="campo">
                <label for="assuntoContato">Assunto</label>
                <select id="assuntoContato">
                    <option value="">Selecione...</option>
                    <option value="pedido">Dúvida sobre pedido</option>
                    <option value="troca">Troca ou devolução</option>
                    <option value="outro">Outros assuntos</option>
                </select>
            </div>
            <div class="campo">
                <label for="msgTexto">Mensagem</label>
                <textarea id="msgTexto" rows="5" placeholder="Digite sua mensagem..."></textarea>
            </div>
            <button type="submit" class="btn-escuro">Enviar Mensagem</button>
            <p id="msgContato" class="msg-retorno"></p>
        </form>
    </main>

    <footer class="rodape">
        <div class="rodape-base">
            <p>&copy; 2026 ShopFacil - Trabalho de Desenvolvimento Web</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>