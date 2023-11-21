<?php
include("cabecalholoja.php");

//Coleta os dados do get
$id = $_GET['var1'];
$quantidade = $_GET['var2'];

//Atualize a quantidade do item no banco de dados
$sql = "UPDATE item_carrinho SET car_item_quantidade = $quantidade WHERE fk_pro_id = $id";
echo $sql;
$resultado = mysqli_query($link, $sql);

header("Location: carrinho.php?id=$idusuario");
?>
