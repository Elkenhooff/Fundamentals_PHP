<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeclientes']) ? $nomeclientes = $_SESSION['nomeclientes'] : "";
$nomeclientes = $_SESSION['nomeclientes'];

isset($_SESSION['idusuario']) ? $idusuario = $_SESSION['idusuario'] : "";
$idusuario = $_SESSION['idusuario'];
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
                <li class="primeiro"><a href="loja.php">Home</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li class="menuloja"><a href="logoutclientes.php">Sair</a></li>

<!-- Valida se a sessão de usuário está autenticada, senão retorne para login. -->
                <?php
                if ($nomeclientes != null) {
                ?>
                    <li class=""><a href="profile.php">OLÁ <?= strtoupper($nomeclientes) ?></a></li>
                <?php
                } else {
                ?>
                    <li class=""><a href="profile.php">OLÁ <?= strtoupper($nomeclientes) ?>aa</a></li>
                <?php
                    echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='loginclientes.php';</script>";
                }
                ?>

            </ul>
        </nav>
    </header>
</body>

</html>