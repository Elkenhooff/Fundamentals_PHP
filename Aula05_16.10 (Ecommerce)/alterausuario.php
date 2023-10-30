<?php
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $ativo = $_POST['ativo'];
    $senha = $_POST['senha'];

    /*#Busca o tempero
    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_nome = '$nome'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $tempero = $tbl[0];
    }
    Caso a senha tenha sido modificada
    if ($senha != $senha2){
        $senha = md5($senha . $tempero);
    }*/

    $sql = "UPDATE usuarios SET usu_senha = '$senha', usu_nome = '$nome', usu_ativo = '$ativo' WHERE usu_id = $id";

    mysqli_query($link,$sql);

    echo ("<script>window.alert('Usuário alterado com sucesso!');</script>");
    echo ("<script>window.location.href='listausuario.php';</script>");
    exit();
}

#Coletando os dados passados via GET
$id = $_GET['id']; #Coletando o ID do Usuário após ter sido clicado na lista usuários.
$sql = "SELECT * FROM usuarios WHERE usu_id = $id";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1]; #Campo nome
    $senha = $tbl[2]; #Campo Senha
    $ativo = $tbl[3]; #Campo Ativo
    #$tempero = $tbl[4]; #Campo tempero
    $senha2 = $senha; #Campo2 senha2 para verificar se foi feita alguma mudança em senha
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Usuário</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>
<body>
    <div class="main-content">
        <form action="alterausuario.php" method="post"> 
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>Senha</label>
            <input type="password" name="senha" value="<?= $senha ?>" required>
            <br>
            <label>Status: <?= $check = ($ativo == 's') ? "Ativo" : "Inativo" ?></label>
            <br>
            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>Ativo<br>
            <input type="radio"  name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>Inativo
            <button type="submit" name="cadastro" id="btn">Alterar</button>
        </form>
    </div>
</body>
</html>