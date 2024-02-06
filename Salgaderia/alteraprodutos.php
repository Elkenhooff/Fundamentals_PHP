<?php


include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

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
</head>
<body>
<form action="alteraprodutos.php" method="post">  
        <label for="nomeProduto">Produto</label><br>
        <input type="text" name="nomeProduto" value="<?=$pro_nome?>" placeholder="Nome do Produto" required>  
        <br>
        <label for="descricaoProduto">Descrição</label><br>
        <textarea name="descricaoProduto" value="<?=$pro_descricao?>" placeholder="Descrição do Produto" required></textarea>
        <br>
        <label for="statusUsuario">Status</label><br>
        <select name="statusUsuario" value<?=$pro_status?>>
        <option value="<?=($pro_status == 's'?'s':'n')?>"><?=($pro_status == 's'?'Ativo':'Inativo')?></option>
        <option value="<?=($pro_status == 's'?'n':'s')?>"><?=($pro_status == 's'?'Inativo':'Ativo')?></option>
        </select>
        <br>
        <label for="pro_custo">Custo</label><br>
        <input type="number" step="0.01" name="custoProduto">
        <br>
        <button type="button" id="btn" onclick="confirmarForm()">Alterar</button>  
        <div id="confirmarForm">
        <h1>Confirme mais uma vez para alterar o usuário.</h1>
        <button type="submit" id="btnform">Alterar</button><button type="button" id="btnform" onclick="confirmarForm()">Cancelar</button>
        </div>
    </form>
</body>
</html>