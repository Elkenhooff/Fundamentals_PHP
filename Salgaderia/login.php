<?php
session_start();

include('conectadb.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $login = $_POST['login'];
    $senha = $_POST['password'];

    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_login = '$login' AND usu_senha = '$senha' usu_status = 's'";
    #Grava a Log no banco de Dados
    $sqllog = "INSERT INTO table_log(tab_query, tab_data) VALUES('$sql', NOW())";

    $retorno = mysqli_query($link, $sql);
    mysqli_query($link, $sqllog);

    while($tbl = mysqli_fetch_array($retorno)){
        $resultado = $tbl[0];
    }

    if ($resultado == 0){
        echo("<script>window.alert('Usuário Incorreto');</script>");
    }
    else{
        $sql = "SELECT * FROM usuarios WHERE usu_login = '$login' AND usu_senha = '$senha' AND usu_status = 's'";
        $retorno = mysqli_query($link, $sql);
        $sqllog = "INSERT INTO table_log(tab_query, tab_data) VALUES('$sql', NOW())";
        mysqli_query($link, $sqllog);
        while ($tbl = mysqli_fetch_array($retorno)){
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
        }
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