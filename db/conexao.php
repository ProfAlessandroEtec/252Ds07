<?php

// Dados de conexão com o banco de dados
$host = 'localhost'; // Endereço do servidor MySQL
$dbname = 'aula'; // Nome do banco de dados
$username = 'root'; // Seu nome de usuário MySQL
$password = ''; // Sua senha do MySQL

// Conexão com banco de dados
try {

    $parametros = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($parametros, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

