<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.html");
    exit;
}

include_once '../db/conexao.php';

$sql = "SELECT idProduto, titulo, descricao FROM produtos ORDER BY titulo"; // Adicionei 'idProduto'
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos</title>
    <link rel="stylesheet" href="../css/paineladm.css"> 
    <link rel="stylesheet" href="../css/relatorios.css">
    <style>
     
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>  <div class="main-content">
        <div class="header">
            <h1>Relatório de Produtos</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <h3>Lista de Produtos Cadastrados</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Ações</th> </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($produto['idProduto']); ?></td>
                            <td><?php echo htmlspecialchars($produto['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                            <td class="action-links">
    <a href="editar_produto.php?id=<?php echo $produto['idProduto']; ?>" class="btn-action edit">Editar</a>
    <a href="excluir_produto.php?id=<?php echo $produto['idProduto']; ?>" class="btn-action delete" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>