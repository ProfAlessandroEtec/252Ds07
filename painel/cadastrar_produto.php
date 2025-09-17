<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../db/conexao.php';

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO produtos (titulo, descricao) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$titulo, $descricao])) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar produto.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../css/paineladm.css">
</head>

<script>
    window.onload = function() {
        var mensagem = document.getElementById('mensagem-status');
        if (mensagem) {
            setTimeout(function() {
                mensagem.style.display = 'none';
            }, 5000); // 5000 milissegundos = 5 segundos
        }
    };
</script>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="header">
            <h1>Cadastro de Produto</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
       <div class="mensagem" id="mensagem-status">
                <?php if (!empty($mensagem)): ?>
                 <?php echo $mensagem; ?>
                <?php endif; ?>
         </div>
            <div class="card">
                <form action="cadastrar_produto.php" method="POST">
                    <div class="form-group">
                        <label for="titulo">Título do Produto:</label>
                        <input type="text" name="titulo" id="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" required></textarea>
                    </div>
                    <button type="submit" class="btn">Cadastrar Produto</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>