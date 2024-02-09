<?php
include("cabecalho.php");

$sql = "SELECT cli_nome, cli_email, cli_telefone, cli_sala, cli_curso, cli_status, cli_id FROM cliente WHERE cli_status ='s';";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == 's'){
        $sql = "SELECT cli_nome, cli_email, cli_telefone, cli_sala, cli_curso, cli_status, cli_id FROM cliente WHERE cli_status = 's';";
        $retorno = mysqli_query($link, $sql);
    }
    else if ($ativo == 'n'){
        $sql = "SELECT cli_nome, cli_email, cli_telefone, cli_sala, cli_curso, cli_status, cli_id FROM cliente WHERE cli_status = 'n';";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT cli_nome, cli_email, cli_telefone, cli_sala, cli_curso, cli_status, cli_id FROM cliente;";
        $retorno = mysqli_query($link, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Clientes</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
        <form action="listaclientes.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()"<?= $ativo == "s"?"checked":""?>>Ativos
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()"<?= $ativo == "n"?"checked":""?>>Inativos
            <input type="radio" name="ativo" class="radio" value="todos" required onclick="submit()"<?= $ativo == "todos"?"checked":""?>>Todos Produtos
        </form>
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Sala</th>
                <th>Curso</th>
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
                <td><?=($tbl[5] == 's'?"Ativo":"Inativo")?></td>
                <td><a href="alteraclientes.php?id=<?=$tbl[6]?>"><input type="button" value="Alterar Clientes"></td>
                </tr>
                <?php
            }
            ?>
        </table>
</body>
</html>