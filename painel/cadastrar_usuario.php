<?php
session_start();

// Proteção da página: só admins podem acessar
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.html");
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../db/conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    // Prepara a query para inserir no banco
    $sql = "INSERT INTO usuario (nomeUsuario, emailUsuario, senhausuario, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Binde os parâmetros e executa
    if ($stmt->execute([$nome, $email, $senha, $tipo])) {
        $mensagem = "Usuário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
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
            <h1>Cadastro de Usuário</h1>
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
                <form action="cadastrar_usuario.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome de Usuário:</label>
                        <input type="text" name="nome" id="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuário:</label>
                        <select name="tipo" id="tipo" required>
                            <option value="comum">Comum</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Cadastrar Usuário</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>