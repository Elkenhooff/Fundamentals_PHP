<?php
include('cabecalholoja.php');

#Pesquisa identificador do carrinho
$sql = "SELECT c.car_id, c.fk_cli_id, c.car_finalizado, p.prod_id, p.prod_nome, p.prod_descrição, p.prod_valor, p.prod_imagem, ic.car_item_quantidade, ic.fk_car_id, ic.fk_pro_id FROM carrinho c JOIN item_carrinho ic ON c.car_id = ic.fk_car_id JOIN produtos p ON ic.fk_pro_id = p.prod_id WHERE c.fk_cli_id = $idusuario AND c.car_finalizado='n'";
$retorno = mysqli_query($link, $sql);
#Usado para fazer a remoção dos itens do inventário
$retorno2 = mysqli_query($link, $sql);
#Usado para fazer o total
$retorno3 = mysqli_query($link, $sql);
#Usado para fazer a finalização do carrinho


$total = 0; #Inicializa a varíavel total

while ($row = mysqli_fetch_assoc($retorno2)){
    $preco = $row['prod_valor'];
    $quantidade = $row['car_item_quantidade'];
    $subtotal = $preco * $quantidade;

    $total += $subtotal;
}

#Tira os itens do inventário
while ($tbl = mysqli_fetch_array($retorno)){
    $sql3 = "SELECT prod_quantidade FROM produtos WHERE prod_id = $tbl[3]";

    $retorno4 = mysqli_query($link, $sql3);
    while ($row = mysqli_fetch_assoc($retorno4)){
        $quantidade_produto = $row['prod_quantidade'];
        $sql4 = "UPDATE produtos SET prod_quantidade = $quantidade_produto - $tbl[8] WHERE prod_id = $tbl[3]";
        $resultado4 = mysqli_query($link,$sql4);
    }
}

$tbl = mysqli_fetch_array($retorno3);
#Inclui o total, data da venda e finaliza o carrinho
$data = date("Y-m-d"); #Pegando o dia atual

#Pegando o total de itens que tem no carrinho
$sql2 = "SELECT COUNT(*) FROM item_carrinho WHERE fk_car_id = $tbl[0]";
$retorno3 = mysqli_query($link, $sql2);
$total_itens = mysqli_fetch_array($retorno3);

#Realizando o update
$sql_total = "UPDATE carrinho SET car_valorvenda = $total, car_datavenda = NOW(), car_finalizado = 's', car_total_item = $total_itens[0] WHERE car_id = $tbl[0]";
echo ($sql_total);
$resultado2 = mysqli_query($link,$sql_total);

header("Location: loja.php");
?>