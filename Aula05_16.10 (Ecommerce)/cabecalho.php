<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeusuario']) ? $nomeusuario = $_SESSION['nomeusuario'] : "";
$nomeusuario = $_SESSION['nomeusuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="cadastrousuario.php">Cadastrar Usuário</a></li>
                <li><a href="listausuario.php">Listar Usuário</a></li>
                <li><a href="cadastroprodutos.php">Cadastrar Produto</a></li>
                <li><a href="listaprodutos.php">Listar Produtos</a></li>
                <li><a href="listacliente.php">Listar Clientes</a></li>
                <li><a href="vendas.php">Vendas</a></li>
                <li class="menuloja"><a href="logout.php">Sair</a></li>

<!-- Valida se a sessão de usuário está autenticada, senão retorne para login. -->
                <?php
                if ($nomeusuario != null) {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
                <?php
                } else {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?>aa</li>
                <?php
                    echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
                }
                ?>

            </ul>
        </nav>
    </header>
</body>

</html>