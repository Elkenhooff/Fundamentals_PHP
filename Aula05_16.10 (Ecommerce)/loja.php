<?php

#Abre conexão com o banco de dados
include("cabecalholoja.php");

#Cria a query que vai ser utilizada
$sql = "SELECT * FROM produtos"; # WHERE prod_ativo = 's'";

#Armazena o resultado da query no $retorno
$retorno = mysqli_query($link, $sql);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Produtos</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>
    <div class="main-content">
        <div class="inicio">
                <!-- Inicio do PHP + HTML -->
                <?php
                #Fazendo preenchimento de tabela usando while (Enquanto tem dados roda pre)
                while ($tbl = mysqli_fetch_array($retorno)) {
                    #Fechamento para trabalhar com HTML simultaneamente
                ?>
                    <div class="compra">
                        <h2><?= $tbl[1] ?></h2> <!-- Traz somente a coluna 1 [Nome] do banco.-->
                        <!-- Ao clicar no botão ele já trará o id do produto para a página do al-->
                        <img src="data:image/jpeg;base64,<?= $tbl[6] ?>" width="100" height="100"></td> <!-- Traz somente a coluna 6 [Imagem] do banco.-->
                        <h2>R$ <?= number_format($tbl[4], 2, ',', '.') ?></h2> <!-- Traz somente a coluna 4 [Valor] do banco.-->
                        <button type="submit" id="btn">Comprar</button>                    
                    </div>
                <?php
                }
                ?>
        </div>
    </div>
</body>

</html>