<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeclientes']) ? $nomeclientes = $_SESSION['nomeclientes'] : "";
$nomeclientes = $_SESSION['nomeclientes'];

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
                <li><a href="loja.php">Home</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li class="menuloja"><a href="logoutclientes.php">Sair</a></li>

<!-- Valida se a sessão de usuário está autenticada, senão retorne para login. -->
                <?php
                if ($nomeclientes != null) {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomeclientes) ?></li>
                <?php
                } else {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomeclientess) ?>aa</li>
                <?php
                    echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.php';</script>";
                }
                ?>

            </ul>
        </nav>
    </header>
</body>

</html>