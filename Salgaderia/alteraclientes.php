<?php
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["idCliente"];
    $nome = $_POST["nomeCliente"];
    $email = $_POST["emailCliente"];
    $telefone = $_POST["telefoneCliente"];
    $sala = $_POST["salaCliente"];
    $curso = $_POST["cursoCliente"];
    $status = $_POST["statusCliente"];

    $sql = "UPDATE cliente SET cli_nome = '$nome', cli_email = '$email', cli_telefone = '$telefone', cli_sala = '$sala', cli_curso = '$curso', cli_status = '$status' WHERE cli_id = $id;";
    mysqli_query($link, $sql);
    echo ("<script>window.alert('Cliente alterado com sucesso!');</script>");
    echo ("<script>window.location.href='listaclientes.php';</script>");
}

$id = $_GET['id'];
$sql = "SELECT cli_id, cli_nome, cli_email, cli_telefone, cli_status, cli_sala, cli_curso FROM cliente WHERE cli_id = $id;";
$retorno = mysqli_query($link, $sql);

while ($coluna = mysqli_fetch_array($retorno)){
    $nomeCliente = $coluna[1];
    $emailCliente = $coluna[2];
    $telefoneCliente = $coluna[3];
    $statusCliente = $coluna[4];
    $salaCliente = $coluna[5];
    $cursoCliente = $coluna[6];
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Clientes</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="">
        <form action="alteraclientes.php" method="post">
            <input type="hidden" name="idCliente" value="<?=$id?>">
            <label for="nomeCliente">Nome</label><br>
            <input type="text" name="nomeCliente" placeholder="xxxxxxxx" value="<?=$nomeCliente?>"><br>
            <label for="emailCliente">Email</label><br>
            <input type="text" name="emailCliente" placeholder="xxxxxxxx@email.com" value="<?=$emailCliente?>"><br>
            <label for="telefoneCliente">Telefone</label><br>
            <input type="text" name="telefoneCliente" placeholder="+xx xx xxxxx-xxxx" value="<?=$telefoneCliente?>"><br>
            <label for="salaCliente">Sala</label><br>
            <input type="text" name="salaCliente" placeholder="xxxxxx" value="<?=$salaCliente?>"><br>
            <label for="salaCliente">Curso</label><br>
            <input type="text" name="cursoCliente" placeholder="xxxxxxxx" value="<?=$cursoCliente?>"><br>
            <label for="statusCliente">Status</label><br>
            <select name="statusCliente" value<?=$statusCliente?>>
                <option value="<?=($statusCliente == 's'?'s':'n')?>"><?=($statusCliente == 's'?'Ativo':'Inativo')?></option>
                <option value="<?=($statusCliente == 's'?'n':'s')?>"><?=($statusCliente == 's'?'Inativo':'Ativo')?></option>
            </select>
            <br>
            <button type="button" id="btn" onclick="confirmarForm()">Alterar</button>  
            <div id="confirmarForm">
            <h1>Confirme mais uma vez para alterar o cliente.</h1>
            <button type="submit" id="btnform">Alterar</button><button type="button" id="btnform" onclick="confirmarForm()">Cancelar</button>
            </div>
        </form>
    </div>
</body>
<script>
    var form = true;
    function confirmarForm(){
        if (form){
            document.getElementById("btn").style.display = "none";
            document.getElementById("confirmarForm").style.display = "block";
            form = false;
        }
        else{
            document.getElementById("btn").style.display = "block";
            document.getElementById("confirmarForm").style.display = "none";
            form = true;
        }
    }
</script>
</html>