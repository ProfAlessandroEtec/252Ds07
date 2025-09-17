<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.html");
    exit;
}

include_once '../db/conexao.php';

$sql = "SELECT idUsuario, nomeUsuario, emailUsuario, tipo FROM usuario ORDER BY nomeUsuario";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Usuários</title>
    <link rel="stylesheet" href="../css/paineladm.css">
       <link rel="stylesheet" href="../css/relatorios.css">
    <style>
        
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>  <div class="main-content">
        <div class="header">
            <h1>Relatório de Usuários</h1>
            <div class="user-info">
                <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                <a href="logout.php" class="logout-btn">Sair</a>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <h3>Lista de Usuários Cadastrados</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ações</th> </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['idUsuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nomeUsuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['emailUsuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['tipo']); ?></td>
                            <td class="action-links">
                                <a href="editar_usuario.php?id=<?php echo $usuario['idUsuario']; ?>" class="btn-action edit">Editar</a>
                                <a href="excluir_usuario.php?id=<?php echo $usuario['idUsuario']; ?>" class="btn-action delete" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
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