<?php

#Inicia a conexão com o banco de dados
include("conectadb.php");

#Coleta de Variáveis via formulário de html
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $file = $_POST['imagem'];

    #Trim no nome e na descrição do produto para impedir o cadastro de produtos e descrições com espaços no começo e fim do texto.
    $nome = trim($nome);
    $descricao = trim($descricao);


    #Passando instruções SQL para o banco.
    #Validando se o produto existe.
    $sql = "SELECT COUNT(prod_id) FROM produtos WHERE prod_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    #Verificação se o produto existe, se existe = 1, se não = 0.
    if ($cont == 1){
        echo ("<script>window.alert('Produto Já Cadastrado!');</script>");
    }
    else{
        #Verificando se caso o nome ou descrição esteja vazios devido ao Trim.
        if ($nome == "" || $descricao == ""){
            echo ("<script>window.alert('Por favor preencha os campos corretamente');</script>");
            echo ("<script>window.location.href='cadastroprodutos.php';</script>"); 
        }
        else{
         $sql = "INSERT INTO produtos(prod_nome, prod_descrição, prod_quantidade, prod_valor, prod_ativo, prod_imagem) VALUES('$nome','$descricao','$quantidade','$valor','n','$file')";
         mysqli_query($link, $sql);
         echo ("<script>window.alert('Produto Cadastrado');</script>");
         echo ("<script>window.location.href='cadastroprodutos.php';</script>"); 
        }
    }
}
#Verificando caso o server não tenha recebido um metodo post.
else if (!$_SERVER["REQUEST_METHOD"] == "POST"){
    echo ("Erro no método post.");
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
        <form action="cadastroprodutos.php" method="post">
            <input type="text" name="nome" placeholder="Nome do produto" required>
            <br>
            <input type="text" name="descricao" placeholder="Descrição do produto" required>
            <br>
            <input type="number" name="quantidade" id="valor" placeholder="Quantidade" min="0" required>
            <br>
            <input type="number" name="valor" id="valor" step="0.01" placeholder="Valor do produto" min="0" required>
            <br>
            <input type="file" name="imagem" id="imagem" placeholder="Insira sua imagem">
            <br>
            <button type="submit" name="cadastro" id="btn">Cadastrar</button>
        </form>
    </div>
    
</body>
</html>