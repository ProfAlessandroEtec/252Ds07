<?php
session_start();

// Verifica se a sessão de usuário existe. Se não, redireciona para o login.
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <p>Este é o seu painel de usuário. Você tem acesso limitado.</p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>