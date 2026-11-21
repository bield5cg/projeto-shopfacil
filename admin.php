<?php
require_once 'conexao.php';

$aviso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $preco = str_replace(',', '.', $_POST['preco'] ?? '0');
    $secao = $_POST['secao'] ?? 'destaque';
    $imagem = trim($_POST['imagem'] ?? '');

    if ($nome !== '' && $categoria !== '' && is_numeric($preco)) {
        $sql = "INSERT INTO produtos (nome, categoria, preco, secao, imagem) VALUES (:nome, :categoria, :preco, :secao, :imagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':preco' => $preco,
            ':secao' => $secao,
            ':imagem' => $imagem
        ]);
        $aviso = 'Produto cadastrado com sucesso!';
    } else {
        $aviso = 'Preencha os campos obrigatórios corretamente.';
    }
}

$produtos = $pdo->query("SELECT * FROM produtos ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel CRUD - ShopFacil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecalho">
        <div class="container cabecalho-flex">
            <a href="index.php" class="logo">Shop<span>Facil</span></a>
            <div class="acoes-topo">
                <a href="index.php" class="link-conta">Voltar à Loja</a>
                <button type="button" class="btn-mobile" id="btnMenuMobile">☰</button>
            </div>
        </div>
    </header>

    <nav class="barra-nav" id="menuPrincipal">
        <div class="container">
            <ul class="nav-lista">
                <li><a href="index.php">Início</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="admin.php" class="ativo">Painel Admin</a></li>
            </ul>
        </div>
    </nav>

    <main class="container secao-interna">
        <h1>Gerenciar Produtos (CRUD)</h1>
        <p class="subtitulo">Cadastre, edite ou exclua itens exibidos na vitrine da loja.</p>

        <?php if ($aviso !== ''): ?>
            <div class="alerta-php"><?= htmlspecialchars($aviso) ?></div>
        <?php endif; ?>

        <section class="box-form">
            <h2>Cadastrar Novo Produto</h2>
            <form method="POST" action="admin.php">
                <div class="campo">
                    <label for="nome">Nome do produto *</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: Caixa de Som Bluetooth">
                </div>
                <div class="linha-dupla">
                    <div class="campo">
                        <label for="categoria">Categoria *</label>
                        <select id="categoria" name="categoria" required>
                            <option value="Eletrônicos">Eletrônicos</option>
                            <option value="Moda">Moda</option>
                            <option value="Casa & Cozinha">Casa & Cozinha</option>
                            <option value="Beleza">Beleza</option>
                            <option value="Esportes">Esportes</option>
                            <option value="Livros">Livros</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="preco">Preço (R$) *</label>
                        <input type="number" step="0.01" id="preco" name="preco" required placeholder="199.90">
                    </div>
                </div>
                <div class="linha-dupla">
                    <div class="campo">
                        <label for="secao">Exibir na seção</label>
                        <select id="secao" name="secao">
                            <option value="destaque">Produtos em Destaque</option>
                            <option value="mais_vendido">Produtos Mais Vendidos</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="imagem">Caminho da imagem (opcional)</label>
                        <input type="text" id="imagem" name="imagem" placeholder="Ex: img/produto.jpg">
                    </div>
                </div>
                <button type="submit" class="btn-escuro">Salvar Produto</button>
            </form>
        </section>

        <section class="box-tabela">
            <h2>Produtos Cadastrados</h2>
            <div class="tabela-scroll">
                <table class="tabela-crud">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Seção</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $p): ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= htmlspecialchars($p['categoria']) ?></td>
                                <td><?= $p['secao'] === 'destaque' ? 'Destaque' : 'Mais Vendido' ?></td>
                                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                                <td class="acoes-td">
                                    <a href="editar.php?id=<?= $p['id'] ?>" class="btn-editar">Editar</a>
                                    <a href="excluir.php?id=<?= $p['id'] ?>" class="btn-excluir" onclick="return confirm('Deseja realmente excluir este produto?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>