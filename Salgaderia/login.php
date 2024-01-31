<?php
session_start();

include('conectadb.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $retorno = mysqli_fetch_array($retorno)[0];

    #Grava a Log no banco de Dados
    $sql = '"'.$sql.'"';
    $sqllog = "INSERT INTO table_log(tab_query, tab_data) VALUES($sql, NOW())";
    mysqli_query($link, $sqllog);

    if ($retorno == 0){
        echo("<script>window.alert('Usuário Incorreto');</script>");
        echo("<script>window.location.href='login.html';</script>");
    }
    else{
        $sql = "SELECT * FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)){
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
        }
        $sql = '"'.$sql.'"';
        $sqllog = "INSERT INTO table_log(tab_query, tab_data) VALUES($sql, NOW())";
        mysqli_query($link, $sqllog);
        echo("<script>window.location.href='backoffice.php';</script>");
    }
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
</body>
</html>