<?php

#Abre conexão com o banco de dados
include('conectadb.php');

#Cria a query que vai ser utilizada
$sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";

#Armazena o resultado da query no $retorno
$retorno = mysqli_query($link, $sql);

#Força sempre a trazer 's' na variável para utilizarmos no radio button
$ativo = "s";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    #Verifica se o usuário está ativo para listar no filtro
    #Se 's' lista, caso ao contrário lista os inativos.
    if ($ativo == 's') {
        $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT * FROM usuarios WHERE usu_ativo = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuários</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>
    <div class="main-content">
        <div id="background">
            <form action="listausuario.php" method="post">
                <!-- Required é usado para o usuario tentar passar em branco o cadastro e impedir o mesmo -->
                <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>> ATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>> INATIVOS
                <br>

            </form>
        </div>
        <div class="container">
            <table border='1'>
                <tr>
                    <th>NOME</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO</th>
                </tr>
                <!-- Inicio do PHP + HTML -->
                <?php

                #Fazendo preenchimento de tabela usando while (Enquanto tem dados roda pre)
                while ($tbl = mysqli_fetch_array($retorno)) {
                #Fechamento para trabalhar com HTML simultaneamente
                ?>
                    <tr>
                        <td><?= $tbl[1] ?></td> <!-- Traz somente a coluna 1 [Nome] do banco.-->
                        <!-- Ao clicar no botão ele já trará o id do usuário para a página do al-->
                        <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"></a></td>
                        <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td>

                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>