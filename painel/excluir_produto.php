<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin' || !isset($_GET['id'])) {
    header("Location: login.html");
    exit;
}

include_once '../db/conexao.php';

$id = $_GET['id'];

// Query para deletar o produto
$sql = "DELETE FROM produtos WHERE idProduto = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    echo "<script>alert('Produto excluído com sucesso!'); window.location.href='relatorio_produtos.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir produto!'); window.location.href='relatorio_produtos.php';</script>";
}

?>