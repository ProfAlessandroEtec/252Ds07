<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html"); // se não estiver logado, volta pro login
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Administrativo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #f4f6f9;
    }
    .sidebar {
      height: 100vh;
      background: #2c3e50;
      color: white;
      padding-top: 20px;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      transition: background 0.3s;
    }
    .sidebar a:hover {
      background: #34495e;
    }
    .main-content {
      padding: 20px;
    }
    .card {
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <nav class="col-md-3 col-lg-2 d-md-block sidebar">
      <h2>Admin</h2>
      <a href="#">🏠 Dashboard</a>
      <a href="#">👤 Usuários</a>
      <a href="#">📦 Produtos</a>
      <a href="#">📊 Relatórios</a>
      <a href="#">⚙️ Configurações</a>
    </nav>

    <!-- Conteúdo -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      
      <!-- Cabeçalho -->
      <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Painel Administrativo</h1>
        <div class="d-flex align-items-center">
          <span class="text-muted me-3">Bem-vindo, Admin</span>
          <!-- Botão Logout -->
          <a href="logout.php" class="btn btn-danger btn-sm">Sair</a>
        </div>
      </div>

      <!-- Cards -->
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card p-3">
            <h5 class="card-title">Visão Geral</h5>
            <p class="card-text">Este é o painel administrativo. Aqui você poderá gerenciar usuários, produtos e visualizar relatórios.</p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card p-3">
            <h5 class="card-title">Últimas Atividades</h5>
            <ul>
              <li>Usuário João cadastrou um novo produto.</li>
              <li>Maria atualizou o estoque.</li>
              <li>Relatório financeiro gerado.</li>
            </ul>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
