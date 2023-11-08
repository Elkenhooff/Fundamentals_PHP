<?php
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $login = $_POST['login'];

    $key = RAND(100000,999999);

    #Inserir instruções no banco
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' OR usu_login = '$login'";
    $resultado = mysqli_query($link,$sql);
    $resultado = mysqli_fetch_array($resultado)[0];

    #Verfica se existe o usuário
    if ($resultado >= 1){
        echo("<script>window.alert('Usuário já cadastrado')</script>");
        echo("<script>window.location.href='login.html'</script>");
    }
    else{
        $sql = "INSERT INTO usuarios(usu_login, usu_senha, usu_status, usu_key, usu_email) VALUES('$login','$senha','s','$key','$email');";
        mysqli_query($link, $sql);

        $sql = '"'.$sql.'"';
        $sqllog = "INSERT INTO table_log(tab_query, tab_data) VALUES($sql, NOW())";
        mysqli_query($link, $sqllog);
        echo("<script>window.alert('Usuário Cadastrado');</script>");
        echo("<script>window.location.href='login.html'</script>");
    }
}


?>
