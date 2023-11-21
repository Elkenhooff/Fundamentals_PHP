<?php
include('cabecalholoja.php');

$idusuario = $_SESSION['idusuario'];

#Pesquisa identificador do carrinho
$sql = "SELECT c.car_id, c.fk_cli_id, c.car_finalizado, p.prod_id, p.prod_nome, p.prod_descrição, p.prod_valor, p.prod_imagem, ic.car_item_quantidade, ic.fk_car_id, ic.fk_pro_id FROM carrinho c JOIN item_carrinho ic ON c.car_id = ic.fk_car_id JOIN produtos p ON ic.fk_pro_id = p.prod_id WHERE c.fk_cli_id = $idusuario AND c.car_finalizado='n'";
$retorno = mysqli_query($link, $sql);

$retorno2 = mysqli_query($link, $sql); #Usado para fazer o total
$total = 0; #Iniciando a varíavel

while ($linhas = mysqli_fetch_assoc($retorno2)) {
    $preco = $linhas['prod_valor'];
    $quantidade = $linhas['car_item_quantidade'];
    $subtotal = $preco * $quantidade;
    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>

    <?php
    while ($tbl = mysqli_fetch_array($retorno)) {
    ?>
            <div class="itens">
                <img src="data:image/jpeg;base64,<?= $tbl[7] ?>" alt="Product Image">
                <h3 class="titulo"><?= $tbl[4] ?></h3>
                <h3 class="preco">R$ <?= $tbl[6] * $tbl[8] ?></h3>
                <label>Quantidade</label>
                <div>
                    <button onclick="location.href='atualizar_carrinho.php?var1=<?= $tbl[3] ?>&var2=<?= $tbl[8] - 1 ?>'" class="butao">-</button>
                    <h3 class="titulo"><?= $tbl[8] ?></h3>
                    <button onclick="location.href='atualizar_carrinho.php?var1=<?= $tbl[3] ?>&var2=<?= $tbl[8] + 1 ?>'" class="butao">+</button>
                </div>
                <br>
                <button onclick="location.href='deletaproduto_carrinho.php?var1=<?= $tbl[3] ?>&var2=<?= $tbl[0] ?>'" class="butao">Excluir do carrinho</button>
            </div>
    <?php
    }
    ?>
    <div class="total" style="width: 100%; height: 30px; ">Total R$ <?= $total ?></div>
    <div class="total" style="width: 100%; height: 30px; "><a href="finaliza_carrinho.php?id=<?= ($idusuario) ?>">Finaliza Carrinho</a></div>
</body>

</html>