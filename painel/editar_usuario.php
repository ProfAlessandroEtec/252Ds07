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
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    // Se a senha foi preenchida, atualiza. Se não, ignora.
    if (!empty($_POST['senha'])) {
        $senha = $_POST['senha'];
        $sql = "UPDATE usuario SET nomeUsuario = ?, emailUsuario = ?, tipo = ?, senhausuario = ? WHERE idUsuario = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $email, $tipo, $senha, $id])) {
            $mensagem = "Usuário atualizado com sucesso!";
        } else {
            $mensagem = "Erro ao atualizar usuário.";
        }
    } else {
        $sql = "UPDATE usuario SET nomeUsuario = ?, emailUsuario = ?, tipo = ? WHERE idUsuario = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $email, $tipo, $id])) {
            $mensagem = "Usuário atualizado com sucesso!";
        } else {
            $mensagem = "Erro ao atualizar usuário.";
        }
    }
}

// Busca os dados do usuário para preencher o formulário
$sql = "SELECT idUsuario, nomeUsuario, emailUsuario, tipo FROM usuario WHERE idUsuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$usuario_edit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario_edit) {
    echo "<script>alert('Usuário não encontrado!'); window.location.href='relatorio.php';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
            <h1>Editar Usuário</h1>
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
                <form action="editar_usuario.php?id=<?php echo $usuario_edit['idUsuario']; ?>" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome de Usuário:</label>
                        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario_edit['nomeUsuario']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario_edit['emailUsuario']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Nova Senha: (Deixe em branco para não alterar)</label>
                        <input type="password" name="senha" id="senha">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuário:</label>
                        <select name="tipo" id="tipo" required>
                            <option value="comum" <?php echo ($usuario_edit['tipo'] === 'comum') ? 'selected' : ''; ?>>Comum</option>
                            <option value="admin" <?php echo ($usuario_edit['tipo'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Salvar Alterações</button>
                    <a href="relatorio_usuario.php" class="btn">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>