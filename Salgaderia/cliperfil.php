<?php
include("cabecalhocliente.php");
$idcliente = $_SESSION['idcliente'];

$sql = "SELECT * FROM cliente WHERE cli_id = $idcliente;";
$retorno = mysqli_query($link, $sql);

while ($coluna = mysqli_fetch_array($retorno)){
    $nome = $coluna[1];
    $email = $coluna[2];
    $telefone = $coluna[3];
    $cpf = $coluna[4];
    $curso = $coluna[5];
    $sala = $coluna[6];
    $imagem = $coluna[10];
    $descricao = $coluna[11];
    $banner = $coluna[12];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="perfil">
        <div class="infoperfil">
            <div class="perfilsup">
            <img src="<?=($banner == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$banner)?>" id="imgbanner">
            <img src="<?=($imagem == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$imagem)?>" id="imgperfil">
            </div>
            <div class="perfilinf">
            <h2><?=$nome?></h2>
            <p><?=$descricao?></p><br><br>
            <label>Email</label>
            <p><?=$email?></p>
            <label>Telefone</label>
            <p><?=$telefone?></p>
            <label>Cpf</label>
            <p><?=$cpf?></p>
            <label>Curso</label>
            <p><?=$curso?></p>
            <label>Sala</label>
            <p><?=$sala?></p>
            </div>
        </div>
    </div>
</body>
</html>