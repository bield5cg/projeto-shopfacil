<?php
require_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $preco = str_replace(',', '.', $_POST['preco'] ?? '0');
    $secao = $_POST['secao'] ?? 'destaque';
    $imagem = trim($_POST['imagem'] ?? '');

    if ($nome !== '' && $categoria !== '' && is_numeric($preco)) {
        $sql = "UPDATE produtos SET nome = :nome, categoria = :categoria, preco = :preco, secao = :secao, imagem = :imagem WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':preco' => $preco,
            ':secao' => $secao,
            ':imagem' => $imagem,
            ':id' => $id
        ]);
        header('Location: admin.php');
        exit;
    }
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - ShopFacil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecalho">
        <div class="container cabecalho-flex">
            <a href="index.php" class="logo">Shop<span>Facil</span></a>
            <a href="admin.php" class="link-conta">Voltar ao Painel</a>
        </div>
    </header>

    <main class="container secao-interna">
        <h1>Editar Produto #<?= $produto['id'] ?></h1>

        <section class="box-form">
            <form method="POST" action="editar.php?id=<?= $produto['id'] ?>">
                <div class="campo">
                    <label for="nome">Nome do produto</label>
                    <input type="text" id="nome" name="nome" required value="<?= htmlspecialchars($produto['nome']) ?>">
                </div>
                <div class="linha-dupla">
                    <div class="campo">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" required>
                            <?php
                            $cats = ['Eletrônicos', 'Moda', 'Casa & Cozinha', 'Beleza', 'Esportes', 'Livros'];
                            foreach ($cats as $c):
                                $sel = ($produto['categoria'] === $c) ? 'selected' : '';
                            ?>
                                <option value="<?= $c ?>" <?= $sel ?>><?= $c ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="preco">Preço (R$)</label>
                        <input type="number" step="0.01" id="preco" name="preco" required value="<?= htmlspecialchars($produto['preco']) ?>">
                    </div>
                </div>
                <div class="linha-dupla">
                    <div class="campo">
                        <label for="secao">Seção</label>
                        <select id="secao" name="secao">
                            <option value="destaque" <?= $produto['secao'] === 'destaque' ? 'selected' : '' ?>>Produtos em Destaque</option>
                            <option value="mais_vendido" <?= $produto['secao'] === 'mais_vendido' ? 'selected' : '' ?>>Produtos Mais Vendidos</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="imagem">Caminho da imagem</label>
                        <input type="text" id="imagem" name="imagem" value="<?= htmlspecialchars($produto['imagem']) ?>">
                    </div>
                </div>
                <button type="submit" class="btn-escuro">Atualizar</button>
                <a href="admin.php" class="btn-cancelar">Cancelar</a>
            </form>
        </section>
    </main>
</body>
</html>