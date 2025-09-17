<?php
 include_once '../db/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $nome_usuario = $_POST['nome_usuario'];

    try {
        $sql = "INSERT INTO clientes (nome_completo, cpf, rg, data_nascimento, telefone, cep, logradouro, numero, bairro, cidade, uf, nome_usuario)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome_completo, $cpf, $rg, $data_nascimento, $telefone, $cep, $logradouro, $numero, $bairro, $cidade, $uf, $nome_usuario]);
        echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='cadastrar_cliente.php';</script>";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
