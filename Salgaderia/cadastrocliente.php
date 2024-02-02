<?php
include("conectadb.php");

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
        echo ("<script>window.location.href='logincliente.html';</script>");
    }
    else{
        $sql = "INSERT INTO cliente(cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo, cli_senha) VALUES('$nome', '$email', $telefone, '$cpf', '$curso', $sala, 's', 0, '$senha');";
        mysqli_query($link, $sql);

        echo ("<script>window.alert('Usuário cadastrado com sucesso.');</script>;");
        echo("<script>window.location.href='logincliente.html';</script>");
    }
}