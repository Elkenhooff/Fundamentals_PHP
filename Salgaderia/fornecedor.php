<?php
include('cabecalho.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];

    $sql = "SELECT COUNT(for_id) from fornecedores WHERE for_nome = '$nome'";
    $retorno = mysqli_query($link,$sql);
    $retorno = mysqli_fetch_array($retorno)[0];

    if ($retorno == 0){
        $sql = "INSERT INTO fornecedores(for_nome) VALUES('$nome')";
        mysqli_query($link,$sql);
        echo("<script>window.alert('Fornecedor cadastrado com sucesso')</script>");
        echo("<script>window.location.href='backoffice.php'</script>");
    } else{
        echo("<script>window.alert('Fornecedor já cadastrado')</script>");
        echo("<script>window.location.href='fornecedor.php'</script>");
    }
}    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="main-content">
        <form action="fornecedor.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome">
            <button type="submit" name="envio" id="btn">Cadastrar</button>
        </form>
    </div>
</body>
</html>