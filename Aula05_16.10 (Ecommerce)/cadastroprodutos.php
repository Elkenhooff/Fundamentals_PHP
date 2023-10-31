<?php

#Inicia a conexão com o banco de dados
include("cabecalho.php");

#Coleta de Variáveis via formulário de html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $file = $_POST['imagem'];

    #Para trocar os "," por "."
    #$valor = str_replace(",", ".", $_POST["preco"]); (Erro?)

    #Trim no nome e na descrição do produto para impedir o cadastro de produtos e descrições com espaços no começo e fim do texto.
    $nome = trim($nome);
    $descricao = trim($descricao);

    #Inserção e criptografia da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']
    ['error'] === UPLOAD_ERR_OK){
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);

        if ($tipo !== false){
            #Se o arquivo é uma imagem
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $imagem_base64 = base64_encode($imagem);
        }
        else{
            #Se o arquivo não é uma imagem
            $imagem = file_get_contents('C:\xampp\htdocs\UC15_PHP\Aula05_16.10 (Ecommerce)\img\noimg.jfif');
            $imagem_base64 = base64_encode($imagem);
        }
    }
    else{
        #Se o arquivo não foi enviado.
        $imagem = file_get_contents('C:\xampp\htdocs\UC15_PHP\Aula05_16.10 (Ecommerce)\img\noimg.jfif');
        $imagem_base64 = base64_encode($imagem);
    }

    #Passando instruções SQL para o banco.
    #Validando se o produto existe.
    $sql = "SELECT COUNT(prod_id) FROM produtos WHERE prod_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }

    #Verificação se o produto existe, se existe = 1, se não = 0.
    if ($cont == 1) {
        echo ("<script>window.alert('Produto Já Cadastrado!');</script>");
    } else {
        #Verificando se caso o nome ou descrição esteja vazios devido ao Trim.
        if ($nome == "" || $descricao == "") {
            echo ("<script>window.alert('Por favor preencha os campos corretamente');</script>");
            echo ("<script>window.location.href='cadastroprodutos.php';</script>");
        } else {
            $sql = "INSERT INTO produtos(prod_nome, prod_descrição, prod_quantidade, prod_valor, prod_ativo, prod_imagem) VALUES('$nome','$descricao','$quantidade','$valor','n','$imagem_base64')";
            mysqli_query($link, $sql);
            echo ("<script>window.alert('Produto Cadastrado');</script>");
            echo ("<script>window.location.href='cadastroprodutos.php';</script>");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>
    <div class="main-content">
        <form action="cadastroprodutos.php" method="post" enctype="multipart/form-data">
            <h2>Cadastro de Produtos</h2>
            <input type="text" name="nome" placeholder="Nome do produto" maxlength="30" required>
            <br>
            <input type="text" name="descricao" placeholder="Descrição do produto" required>
            <br>
            <input type="number" name="quantidade" id="valor" placeholder="Quantidade" min="0" required>
            <br>
            <input type="number" name="valor" id="valor" step="0.01" placeholder="Valor do produto" min="0" required>
            <br>
            <input type="file" name="imagem" placeholder="Insira sua imagem">
            <br>
            <button type="submit" name="cadastro" id="btn">Cadastrar</button>
        </form>
    </div>

</body>

</html>