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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cliNome = $_POST['nome'];
    $cliDescricao = $_POST['descricao'];
    $cliTelefone = $_POST['telefone'];
    $cliImagem = $_POST['foto'];
    $cliBanner = $_POST['banner'];

    $sql = "UPDATE cliente SET cli_nome = '$cliNome', cli_descricao = '$cliDescricao', cli_telefone = '$cliTelefone', cli_imagem = '$cliImagem', cli_banner = '$banner' WHERE cli_id = $idcliente;";
    mysqli_query($link,$sql);
    echo ("<script>window.location.href='cliperfil.php';</script>");
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
    <form action="cliconfig.php" method="post" enctype="multipart/form-data">
        <div class="infoperfil">
            <div class="perfilsup">
            <img src="<?=($banner == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$banner)?>" id="imgbanner" name="foto"><br>
            <img src="<?=($imagem == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$imagem)?>" id="imgperfil" name="banner">
            </div>
            <div class="perfilinf" id="configperfil">
            <label>Nome</label>
            <input type="text" name="nome" value="<?=$nome?>"><br>
            <label>Descrição</label>
            <textarea name="descricao" ><?=$descricao?></textarea><br>
            <label>Telefone</label>
            <input type="tel" name="telefone" value="<?=$telefone?>"><br>
            <button type="submit" id="btn">Enviar</button>
            </div>
        </div>
    </form>
    </div>
</body>
</html> 