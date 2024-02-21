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
    
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['banner']['tmp_name'];
        $imagembanner = file_get_contents($imagem_temp);
        $imagembanner64 = base64_encode($imagembanner);
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['foto']['tmp_name'];
        $imagemfoto = file_get_contents($imagem_temp);
        $imagemfoto64 = base64_encode($imagembanner);
    }

    
    $sql = "UPDATE cliente SET cli_nome = '$cliNome', cli_descricao = '$cliDescricao', cli_telefone = '$cliTelefone' WHERE cli_id = $idcliente;";
    mysqli_query($link,$sql);
    $sql = "UPDATE cliente SET cli_imagem = '$imagemfoto64' WHERE cli_id = $idcliente";
    mysqli_query($link,$sql);
    $sql = "UPDATE cliente SET cli_banner = '$imagembanner64'  WHERE cli_id = $idcliente";
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
            <img src="<?=($banner == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$banner)?>" id="imgbanner" name="foto">
            <i><img src="./img/imgbanner.png" id="editar"></i>
            <img src="<?=($imagem == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$imagem)?>" id="imgperfil" name="banner">
            <i><img src="./img/imgbanner.png" id="editar2"></i>
            </div>
            <div class="perfilinf" id="configperfil">
            <label>Nome</label>
            <input type="text" name="nome" value="<?=$nome?>"><br>
            <label>Descrição</label>
            <textarea name="descricao" ><?=$descricao?></textarea><br>
            <label>Telefone</label>
            <input type="tel" name="telefone" value="<?=$telefone?>"><br>
            <input type="file" name="banner" id="inputbanner">
            <input type="file" name="foto" id="inputfoto"><br>
            <button type="submit" id="btn">Enviar</button>
            </div>
        </div>
    </form>
    </div>
</body>
<script>
    document.getElementById("editar").addEventListener("click", function (){
        document.getElementById("inputbanner").click();
    })

    document.getElementById("editar2").addEventListener("click", function (){
        document.getElementById("inputfoto").click();
    })
    </script>

</html> 