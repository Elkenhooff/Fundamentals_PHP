<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomecliente']) ? $nomecliente = $_SESSION['nomecliente'] : "";
$nomecliente = $_SESSION['nomecliente'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="encomendas.php">Encomendas</a></li>
                <li class="menuloja"><a href="logoutcliente.php">Sair</a></li>

<!-- Valida se a sessão de usuário está autenticada, senão retorne para login. -->
                <?php
                if ($nomecliente != null) {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomecliente) ?></li>
                <?php
                } else {
                ?>
                    <li class="profile">OLÁ <?= strtoupper($nomecliente) ?></li>
                <?php
                    #echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='logincliente.html';</script>";
                }
                ?>

            </ul>
        </nav>
    </header>
</body>
</html>