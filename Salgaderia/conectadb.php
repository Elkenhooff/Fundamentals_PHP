<?php
$host = 'localhost';
$dbname = 'Saguadim';
$username = 'root';
$password = '123@@';

try {
    // Estabelece uma conexao com o banco de dados MySQL
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configura o conjunto de caracteres para UTF-8
    $conexao->exec("SET NAMES utf8");
    $conexao->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    // Em caso de erro na conexao, exibe uma mensagem de erro
    echo "Erro ao conectar com o Banco de Dados:<br> " . $e->getMessage();
}
?>

