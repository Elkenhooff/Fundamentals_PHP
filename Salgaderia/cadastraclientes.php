<?php
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nomecliente"];
    $email = $_POST["emailcliente"];
    $senha = $_POST["senhacliente"];
    $telefone = $_POST["telefonecliente"];
    $cpf = $_POST["cpfcliente"];
    $curso = $_POST["cursocliente"];
    $sala = $_POST["salacliente"];

    $sql = "SELECT COUNT(cli_id) from cliente WHERE cli_email = '$email';";
    $retorno = mysqli_query($link, $sql);
    $contador = mysqli_fetch_array($retorno)[0];
    if ($contador > 0){
        echo ("<script>window.alert('Usuário já cadastrado.');</script>");
        echo ("<script>window.location.href='cadastraclientes.html';</script>");
    }
    else{
        $sql = "INSERT INTO cliente(cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo, cli_senha) VALUES('$nome', '$email', $telefone, '$cpf', '$curso', $sala, 's', 0, '$senha');";
        mysqli_query($link, $sql);

        echo ("<script>window.alert('Usuário cadastrado com sucesso.');</script>;");
        echo("<script>window.location.href='listaclientes.php';</script>");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Clientes</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <form action="cadastraclientes.php" method="post">
        <label for="nomecliente">Nome</label>
        <input type="text" name="nomecliente" placeholder="xxxxxxxx"><br>
        <label for="emailcliente">Email</label>
        <input type="text" name="emailcliente" placeholder="xxxxxxxx@email.com"><br>
        <label for="senhacliente">Senha</label>
        <input type="password" name="senhacliente" placeholder="********"><br>
        <label for="telefonecliente">Telefone</label>
        <input type="tel" name="telefonecliente" placeholder="xxxxxxxx"><br>
        <label for="cpfcliente">CPF</label>
        <input type="number" name="cpfcliente" placeholder="xxxxxxxx"><br>
        <label for="cursocliente">Curso</label>
        <input type="text" name="cursocliente" placeholder="xxxxxxxx" min="0"><br>
        <label for="salacliente">Sala</label>
        <input type="number" name="salacliente" placeholder="xxxxxxxx"><br>
        <button type="submit" id="btn">Cadastrar</button>
    </form>
</body>
</html>