<?php
#Incluindo o cabecalho (Conexão com o banco + Nav Principal)
include("cabecalho.php");

#Inserindo o comando SQL que permitira encontrar somente o nome do usuário, email e status do usuário que estão ativos.
$sql = "SELECT usu_id, usu_login, usu_email, usu_status FROM usuarios WHERE usu_status = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = 's';

#Verifica qual é a atual marcação recebida no metodo post do input tipo radio no html.
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $ativo = $_POST['ativo'];

    if ($ativo == 's'){
        $sql = "SELECT usu_id, usu_login, usu_email, usu_status FROM usuarios WHERE usu_status = 's'";
        $retorno = mysqli_query($link, $sql);
    }
    else if ($ativo == 'n'){
        $sql = "SELECT usu_id, usu_login, usu_email, usu_status FROM usuarios WHERE usu_status = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT usu_id, usu_login, usu_email, usu_status FROM usuarios";
        $retorno = mysqli_query($link, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <form action="listausuarios.php" method="post">
        <!--Cria inputs para filtrar os usuários.-->
            <input type="radio" name="ativo" value="s" required onclick="submit()"<?= $ativo == "s"?"checked":""?>>Ativos
            <input type="radio" name="ativo" value="n" required onclick="submit()"<?= $ativo == "n"?"checked":""?>>Inativos
            <input type="radio" name="ativo" value="todos" required onclick="submit()"<?= $ativo == "todos"?"checked":""?>>Todos Usuários
    </form>
    <table border="1">
        <tr>
            <td>Usuário</td>
            <td>Email</td>
            <td>Status</td>
        </tr>
        <?php
        while ($tbl = mysqli_fetch_array($retorno)){
            #Abre o php e fecha em seguida para trabalhar com php e html simultaneamente.
            ?>
            <tr>
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[2]?></td>
                <td><?=$tbl[3]?></td>
            </tr>
            <?php
            #Finaliza o fechamento do while.
        }
        ?>
    </table>
</body>
</html>