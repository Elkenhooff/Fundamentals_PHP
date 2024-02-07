<?php
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $produto = $_POST["nomeProduto"];
    $descricao = $_POST["descricaoProduto"];
    $custo = $_POST["custoProduto"];
    $preco = $_POST["precoProduto"];
    $quantidade = $_POST["quantidadeProduto"];
    $validade = $_POST["validadeProduto"];
    $fornecedor = $_POST["fornecedorProduto"];
    $ativo = $_POST["statusUsuario"];

    $sql = "UPDATE produtos SET pro_nome = '$produto', pro_descricao = '$descricao', pro_custo = $custo, pro_preco = $preco, pro_quantidade = $quantidade, pro_validade = '$validade', fk_for_id = $fornecedor, pro_status = '$ativo' WHERE pro_id = $id;";
    echo $sql;
    mysqli_query($link, $sql);
    echo ("<script>window.alert('Produto Alterado com Sucesso!');</script>");
    echo ("<script>window.location.href='listaprodutos.php';</script>");
}

$idproduto = $_GET["id"];
$sql = "SELECT * FROM produtos WHERE pro_id = '$idproduto';";
$retorno = mysqli_query($link, $sql);

while ($coluna = mysqli_fetch_array($retorno)){
    $pro_id = $coluna[0];
    $pro_nome = $coluna[1];
    $pro_descricao = $coluna[2];
    $pro_custo = $coluna[3];
    $pro_preco = $coluna[4];
    $pro_quantidade = $coluna[5];
    $pro_validade = $coluna[6];
    $pro_fk_id = $coluna[7];
    $pro_status = $coluna[8];
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altera Produto</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<form action="alteraprodutos.php" method="post">  
        <input type="hidden" name="id" value="<?=$pro_id?>">  
        <label for="nomeProduto">Produto</label><br>
        <input type="text" name="nomeProduto" value="<?=$pro_nome?>" placeholder="Nome do Produto" >  
        <br>
        <label for="descricaoProduto">Descrição</label><br>
        <textarea name="descricaoProduto" placeholder="Descrição do Produto" rows="5" cols="21" required><?=$pro_descricao?></textarea>
        <br>
        <label for="custoProduto">Custo</label><br>
        <input type="number" step="0.01" name="custoProduto" value="<?=$pro_custo?>" required>
        <br>
        <label for="precoProduto">Preço</label><br>
        <input type="number" step="0.01" name="precoProduto" value="<?=$pro_preco?>" required>
        <br>
        <label for="quantidadeProduto">Quantidade</label><br>
        <input type="number" name="quantidadeProduto" value="<?=$pro_quantidade?>" required>
        <br>
        <label for="validadeProduto">Validade</label><br>
        <input type="date" name="validadeProduto" value="<?=$pro_validade?>" required>
        <br>
        <label for="fornecedorProduto">Fornecedor</label><br>
        <select name="fornecedorProduto" required>
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
        <br>
        <label for="statusUsuario">Status</label><br>
        <select name="statusUsuario" value<?=$pro_status?>>
        <option value="<?=($pro_status == 's'?'s':'n')?>"><?=($pro_status == 's'?'Ativo':'Inativo')?></option>
        <option value="<?=($pro_status == 's'?'n':'s')?>"><?=($pro_status == 's'?'Inativo':'Ativo')?></option>
        </select>
        <br>
        <button type="button" id="btn" onclick="confirmarForm()">Alterar</button>  
        <div id="confirmarForm">
        <h1>Confirme mais uma vez para alterar o usuário.</h1>
        <button type="submit" id="btnform">Alterar</button><button type="button" id="btnform" onclick="confirmarForm()">Cancelar</button>
        </div>
    </form>
</body>
<script>
    var form = true;
    function confirmarForm(){
        if (form){
            document.getElementById("btn").style.display = "none";
            document.getElementById("confirmarForm").style.display = "block";
            form = false;
        }
        else{
            document.getElementById("btn").style.display = "block";
            document.getElementById("confirmarForm").style.display = "none";
            form = true;
        }
    }
</script>
</html>