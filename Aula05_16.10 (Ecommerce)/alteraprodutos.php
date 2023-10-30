<?php
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $ativo = $_POST['ativo'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $imagem_base64 = $_POST['imagem'];
    $imagem_atual = $_POST['imagem_atual'];

    $nome = trim($nome);
    $descricao = trim($descricao);

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);

        if ($tipo !== false) {
            #Se o arquivo é uma imagem
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $imagem_base64 = base64_encode($imagem);
        } else {
            #Se o arquivo não é uma imagem
            $imagem = file_get_contents('C:\xampp\htdocs\UC15_PHP\Aula05_16.10 (Ecommerce)\img\noimg.jfif');
            $imagem_base64 = base64_encode($imagem);
        }
    }

    if ($imagem_atual == $imagem_base64) {
        $sql = "UPDATE produtos SET prod_nome = '$nome', prod_descrição = '$descricao', prod_quantidade = '$quantidade', prod_valor = '$valor', prod_ativo = '$ativo' WHERE prod_id = $id";

        mysqli_query($link, $sql);

        echo ("<script>window.alert('Produto alterado com sucesso!');</script>");
        echo ("<script>window.location.href='listaprodutos.php';</script>");
        exit();
    } else {
        $sql = "UPDATE produtos SET prod_nome = '$nome', prod_descrição = '$descricao', prod_quantidade = '$quantidade', prod_valor = '$valor', prod_ativo = '$ativo', prod_imagem = '$imagem_base64' WHERE prod_id = $id";

        mysqli_query($link, $sql);

        echo ("<script>window.alert('Produto alterado com sucesso!');</script>");
        echo ("<script>window.location.href='listaprodutos.php';</script>");
        exit();
    }
}

#Coletando os dados passados via GET
$id = $_GET['id']; #Coletando o ID do Usuário após ter sido clicado na lista usuários.
$sql = "SELECT * FROM produtos WHERE prod_id = $id";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nome = $tbl[1]; #Campo nome do produto
    $descricao = $tbl[2]; #Campo descrição do produto
    $quantidade = $tbl[3]; #Campo quantidade do produto
    $valor = $tbl[4]; #Campo valor do produto
    $ativo = $tbl[5]; #Campo status
    $imagem_atual = $tbl[6];
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
    <div class="main-content2">
        <form action="alteraprodutos.php" method="post" enctype="multipart/form-data">
            <h2>Alteração de Produto</h2>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label>
            <input type="text" name="nome" maxlength="30" value="<?= $nome ?>" required>
            <label>Descrição</label>
            <input type="text" name="descricao" required value="<?= $descricao ?>">
            <label>Quantidade</label>
            <input type="number" name="quantidade" id="valor" min="0" required value="<?= $quantidade ?>">
            <label>Valor</label>
            <input type="number" name="valor" id="valor" step="0.01" min="0" required value="<?= $valor ?>">
            <label>Imagem</label>
            <input type="file" name="imagem" value="<?= $imagem_base64 ?>">
            <label>Status: <?= $check = ($ativo == 's') ? "Ativo" : "Inativo" ?></label>
            <br>
            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>Ativo<br>
            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>Inativo
            <button type="submit" name="cadastro" id="btn">Alterar</button>
        </form>
    </div>
    <div id="imagem">
        <h2>Imagem Atual</h2>
        <td><img name="imagem_atual" class="imagem_atual" src="data:imagem/jpeg;base64, <?= $imagem_atual ?>"></td>
    </div>
</body>

</html>