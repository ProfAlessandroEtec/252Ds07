<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: login.html");
    exit;
}

include_once '../db/conexao.php';

$id = $_GET['id'];
$mensagem = '';

// Se o formulário de edição foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE produtos SET titulo = ?, descricao = ? WHERE idProduto = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$titulo, $descricao, $id])) {
        $mensagem = "Produto atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar produto.";
    }
}

// Busca os dados do produto para preencher o formulário
$sql = "SELECT titulo, descricao FROM produtos WHERE idProduto = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$produto_edit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto_edit) {
    echo "<script>alert('Produto não encontrado!'); window.location.href='relatorio_produtos.php';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/paineladm.css">
</head>
<body>
    <?php include 'sidebar.php'; ?> <div class="main-content">
        <div class="header">
            <h1>Editar Produto</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
        <div class="content">
      <div class="mensagem" id="mensagem-status">
                <?php if (!empty($mensagem)): ?>
                 <?php echo $mensagem; ?>
                <?php endif; ?>
         </div>
            <div class="card">
                <form action="editar_produto.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="titulo">Título do Produto:</label>
                        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($produto_edit['titulo']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" required><?php echo htmlspecialchars($produto_edit['descricao']); ?></textarea>
                    </div>
                    <button type="submit" class="btn">Salvar Alterações</button>
                    <a href="relatorio_produtos.php" class="btn">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>