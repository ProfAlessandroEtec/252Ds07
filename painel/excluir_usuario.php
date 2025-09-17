<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: login.html");
    exit;
}

include_once '../db/conexao.php';

$id = $_GET['id'];

// Query para deletar o usuário
$sql = "DELETE FROM usuario WHERE idUsuario = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='relatorio.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir usuário!'); window.location.href='relatorio.php';</script>";
}

?>