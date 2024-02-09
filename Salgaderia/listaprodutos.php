<?php
include("cabecalho.php");

$sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_validade, fk_for_id, pro_id, pro_status FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == 's') {
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_validade, fk_for_id, pro_id, pro_status FROM produtos WHERE pro_status = 's'";
        $retorno = mysqli_query($link, $sql);
    } else if ($ativo == 'todos') {
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_validade, fk_for_id, pro_id, pro_status FROM produtos ORDER BY pro_id";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_validade, fk_for_id, pro_id, pro_status FROM produtos WHERE pro_status = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <form action="listaprodutos.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()"<?= $ativo == "s"?"checked":""?>>Ativos
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()"<?= $ativo == "n"?"checked":""?>>Inativos
            <input type="radio" name="ativo" class="radio" value="todos" required onclick="submit()"<?= $ativo == "todos"?"checked":""?>>Todos Produtos
        </form>
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Preço</th>
                <th>Validade</th>
                <th>Fornecedor</th>
                <th>Status</th>
                <th>Alterar</th>
            </tr>
        <!-- Trazendo dados da tabela -->
        <?php
            while($tbl = mysqli_fetch_array($retorno)){
                ?>
                <tr>
                <td><?=$tbl[0]?></td>
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[2]?></td>
                <td><?=$tbl[3]?></td>
                <td><?=$tbl[4]?></td>
                <td><?=$tbl[5]?></td>
                <td><?=($tbl[7] == 's'?"Ativo":"Inativo")?></td>
                <td><a href="alteraprodutos.php?id=<?=$tbl[6]?>"><input type="button" value="Alterar Produto"></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>