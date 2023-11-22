<?php
include('cabecalho.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $validade = $_POST['validade'];
    $fornecedor_id = $_POST['fornecedor'];

    $sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome'";
    $retorno = mysqli_query($link,$sql);
    $cont = (mysqli_fetch_array($retorno)[0]);
    if ($cont == 0){
        $sql = "INSERT INTO produtos(pro_nome, pro_descricao, pro_custo, pro_preco, pro_quantidade, pro_validade, fk_for_id, pro_status) VALUES ('$nome','$descricao', $custo, $preco, $quantidade, '$validade', $fornecedor_id, 's')";
        mysqli_query($link,$sql);
        echo("<script>window.alert('Produto cadastrado com sucesso');</script>");
        echo("<script>window.location.href='listaproduto.php';</script>");
    }
    else{
        echo("<script>window.alert('Produto já cadastrado');</script>");
        echo("<script>window.location.href='cadastraproduto.php';</script>");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="main-content">
        <form action="cadastraproduto.php" method="post">
            <label>Nome Produto</label>
            <input type="text" name="nome">
            <label>Descrição</label>
            <textarea name="descricao"></textarea>
            <label>Custo</label>
            <input type="number" name="custo" step="0.01">
            <label>Preço</label>
            <input type="number" name="preco" step="0.01">
            <label>Quantidade</label>
            <input type="number" min="0" name="quantidade">
            <label>Validade</label>
            <input type="date" name="validade">
            <label>Fornecedores</label>
            <select name="fornecedor" required>
                <?php
                $sql = "SELECT for_id, for_nome from fornecedores";
                $retorno = mysqli_query($link, $sql);
                while($tbl = mysqli_fetch_array($retorno)){
                    ?>
                    <option value=<?=$tbl[0]?>><?=$tbl[1]?></option>
                    <?php
                }
                ?>
            </select>
            <button type="submit" id="btn">Cadastrar</button>
        </form>
    </div>
</body>
</html>