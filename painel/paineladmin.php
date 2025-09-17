<?php
session_start();

// Verifica se a sessão de usuário existe E se o tipo é "admin"
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    // Se não for admin, redireciona de volta para o login
    header("Location: login.html");
    

    exit;
  
}else{
    $usuario = $_SESSION['usuario'];
}


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo</title>
<link rel="stylesheet" href="../css/paineladm.css">

</head>
<body>
  <!-- Sidebar -->
  <?php include 'sidebar.php'; ?>

  <!-- Conteúdo principal -->
  <div class="main-content">
    <div class="header">
      <h1>Painel Administrativo</h1>
      <div class="user-info">
        <span>Bem-vindo,<?php echo htmlspecialchars($usuario); ?></span>
        <!-- Botão Logout -->
        <a href="logout.php" class="logout-btn">Sair</a>
      </div>
    </div>
    <div class="content">
      <div class="card">
        <h3>Visão Geral</h3>
        <p>Este é o painel administrativo. Aqui você poderá gerenciar usuários, produtos e visualizar relatórios.</p>
      </div>
      <div class="card">
        <h3>Últimas Atividades</h3>
        <ul>
          <li>Usuário João cadastrou um novo produto.</li>
          <li>Maria atualizou o estoque.</li>
          <li>Relatório financeiro gerado.</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
