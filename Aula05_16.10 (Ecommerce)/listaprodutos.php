<?php

#Abre conexão com o banco de dados
include('conectadb.php');

#Cria a query que vai ser utilizada
$sql = "SELECT * FROM produtos WHERE prod_ativo = 's'";

#Armazena o resultado da query no $retorno
$retorno = mysqli_query($link, $sql);

#Força sempre a trazer 's' na variável para utilizarmos no radio button
$ativo = "s";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    #Verifica se o produto está ativo para listar no filtro
    #Se 's' lista, caso ao contrário lista os inativos.
    if ($ativo == 's') {
        $sql = "SELECT * FROM produtos WHERE prod_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
    } else if ($ativo == 't') {
        $sql = "SELECT * FROM produtos ORDER BY prod_id";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT * FROM produtos WHERE prod_ativo = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}

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
        <div id="background">
            <form action="listaprodutos.php" method="post">
                <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == "s" ? "checked" : "" ?>>ATIVOS</input>
                <br>
                <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == "n" ? "checked" : "" ?>>INATIVOS</input>
                <br>
                <input type="radio" name="ativo" class="radio" value="t" required onclick="submit()" <?= $ativo == "t" ? "checked" : "" ?>>TODOS</input>
            </form>
        </div>
        <div class="container">
            <table border='1'>
                <tr>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>QUANTIDADE<br>ESTOQUE</th>
                    <th>VALOR</th>
                    <th>IMAGEM</th>
                    <th>ATIVO</th>
                    <th>ALTERAR DADOS</th>
                </tr>
                <!-- Inicio do PHP + HTML -->
                <?php

                #Fazendo preenchimento de tabela usando while (Enquanto tem dados roda pre)
                while ($tbl = mysqli_fetch_array($retorno)) {
                    #Fechamento para trabalhar com HTML simultaneamente
                ?>
                    <tr>
                        <td><?= $tbl[1] ?></td> <!-- Traz somente a coluna 1 [Nome] do banco.-->
                        <!-- Ao clicar no botão ele já trará o id do produto para a página do al-->
                        <td><?= $tbl[2] ?></td> <!-- Traz somente a coluna 2 [Descrição] do banco.-->
                        <td><?= $tbl[3] ?></td> <!-- Traz somente a coluna 3 [Quantidade] do banco.-->
                        <td>R$ <?= number_format($tbl[4], 2, ',', '.') ?></td> <!-- Traz somente a coluna 4 [Valor] do banco.-->
                        <td><img src="data:image/jpeg;base64,<?= $tbl[6] ?>" width="100" height="100"></td> <!-- Traz somente a coluna 6 [Imagem] do banco.-->
                        <td><?= $check = ($tbl[5] == "s") ? "SIM" : "NÃO" ?></td>
                        <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>