<?php
session_start(); // INICIA A SESSÃO

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    header("Location: login.html"); 
    exit;
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

include_once '../db/conexao.php'; // Inclui o arquivo de conexão com o banco de dados


// Busca no banco
// Adicionado "tipo" na consulta para verificar o tipo de usuário
$sql = "SELECT idUsuario, nomeUsuario, emailUsuario, senhausuario, tipo FROM usuario WHERE nomeUsuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $usuario);
$stmt->execute();
$usuarioDB = $stmt->fetch(PDO::FETCH_ASSOC); // Usar FETCH_ASSOC para um array associativo

if ($usuarioDB && $senha === $usuarioDB['senhausuario']) { // Ideal: usar password_verify()
    $_SESSION['usuario'] = $usuarioDB['nomeUsuario'];
    $_SESSION['id'] = $usuarioDB['idUsuario'];
    $_SESSION['tipo'] = $usuarioDB['tipo']; // Armazena o tipo de usuário na sessão

    // Lógica de redirecionamento com base no tipo de usuário
    if ($_SESSION['tipo'] === 'admin') {
        header("Location: paineladmin.php");
        exit;
    } else {
        header("Location: painelusuario.php");
        exit;
    }
} else {
    echo "<script>alert('Login Inválido'); window.location.href='login.html';</script>";
}

?>