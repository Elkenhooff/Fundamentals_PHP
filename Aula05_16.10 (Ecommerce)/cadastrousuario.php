<?php

#Inicia a conexão com o banco de dados
include("conectadb.php");

#Coleta de Variáveis via formulário de html
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    #Passando instruções SQL para o banco
    #Validando se o usuário existe
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    #Verificação se o usuario existe, se existe = 1, se não = 0.
    if ($cont == 1){
        echo ("<script>window.alert('Usuário Já Cadastrado!');</script>");
    }
    else{
        $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo) VALUES('$nome', '$senha', 'n')";
        mysqli_query($link, $sql);
        echo ("<script>window.alert('Usuário Cadastrado');</script>");
        echo ("<script>window.location.href='cadastrousuario.php';</script>");
    }
}
else{
    echo ("Erro no método post.");
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>
<body>
    <div class="main-content">
        <form action="cadastrousuario.php" method="post">
            <input type="text" name="nome" id="nome" placeholder="Nome do Usuário" required>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <br>
            <input type="submit" name="cadastro" id="cadastro" placeholder="Cadastrar">
        </form>
    </div>
    
</body>
</html>
