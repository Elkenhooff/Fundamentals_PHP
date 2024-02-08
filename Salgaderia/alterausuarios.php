<?php

include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $nomeusuario = $_POST["nomeUsuario"];
    $status = $_POST["statusUsuario"];
    $senha = $_POST["senhaUsuario"];

    $sql = "UPDATE usuarios SET usu_login = '$nomeusuario', usu_senha = '$senha', usu_status = '$status' WHERE usu_id = $id;";
    mysqli_query($link, $sql);

    echo ("<script>window.alert('Usuário alterado com sucesso!');</script>");
    echo ("<script>window.location.href='listausuarios.php';</script>");
}

$id = $_GET['id']; #Coletando o ID do Usuário após ter sido clicado na lista usuários.
$sql = "SELECT usu_login, usu_senha, usu_status FROM usuarios WHERE usu_id = $id";
$retorno = mysqli_query($link, $sql);

while($coluna = mysqli_fetch_array($retorno)){
    $nome = $coluna[0];
    $senha = $coluna[1];
    $status = $coluna[2];
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Usuários</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <form action="alterausuarios.php" method="post">
        <input type="hidden" name="id" value="<?=$id?>">  
        <label for="nomeUsuario">Usuário</label><br>
        <input type="text" name="nomeUsuario" value="<?=$nome?>" placeholder="Nome do Usuário" required>  
        <br>
        <label for="senhaUsuario">Senha</label><br>
        <input type="password" name="senhaUsuario" value=<?=$senha?> placeholder="********" required>
        <br>
        <label for="statusUsuario">Status</label><br>
        <select name="statusUsuario" value<?=$status?>>
        <option value="<?=($status == 's'?'s':'n')?>"><?=($status == 's'?'Ativo':'Inativo')?></option>
        <option value="<?=($status == 's'?'n':'s')?>"><?=($status == 's'?'Inativo':'Ativo')?></option>
        </select>
        <br>
        <button type="button" id="btn" onclick="confirmarForm()">Alterar</button>  
        <div id="confirmarForm">
        <h1>Confirme mais uma vez para alterar o usuário.</h1>
        <button type="submit" id="btnform">Alterar</button><button type="button" id="btnform" onclick="confirmarForm()">Cancelar</button>
        </div>
    </form>
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