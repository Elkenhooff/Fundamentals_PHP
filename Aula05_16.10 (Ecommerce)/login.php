<?php
session_start();

include("conectadb.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nomeusuario'];
    $senha = $_POST['senha'];
    $tempero = "";

    #Busca o Tempero
    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $tempero = $tbl[0];
    }

    $senha = md5($senha . $tempero);

    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }
    
    if ($cont == 1) {
        $sql = "SELECT * FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)) {
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
        }
        echo ("<script>window.location.href='listausuario.php';</script>");
    } else {
        echo ("<script>window.alert('Usuário ou senha incorretos!'");
        echo ("<script>window.location.href='listausuario.php';</script>");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>
    <div class="main-content">
        <form action="login.php" method="post">
            <h2>Login de Usuário</h2>
            <input type="text" name="nomeusuario" id="nome" placeholder="Nome" required>
            <br>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <span id="MostrarSenha" class="MostrarSenha" onclick="MostrarSenha()">👀</span>
            <br>
            <button type="submit" id="btn" name="login">Login</button>
        </form>
    </div>
</body>
<script>
    function MostrarSenha(){
        var senhaInput = document.getElementById("senha");
        var senhaIcone = document.getElementById("MostrarSenha");

        if (senhaInput.type === "password"){
            senhaInput.type = "text";
            senhaIcone.textContent = "🙈";
        }
        else{
            senhaInput.type = "password";
            senhaIcone.textContent = "👀";
        }
    }
</script>
</html>