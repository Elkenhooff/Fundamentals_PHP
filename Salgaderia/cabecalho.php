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
    <title></title>
</head>

<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="cadastraclientes.php">Cadastrar Clientes</a></li>
                <li><a href="cadastraproduto.php">Cadastrar Produto</a></li>
                <li><a href="listausuarios.php">Listar Usuário</a></li>
                <li><a href="listaclientes.php">Listar Clientes</a></li>
                <li><a href="listaprodutos.php">Listar Produtos</a></li>
                <li><a href="encomendas.php">Encomendas</a></li>
                <li><a href="fornecedor.php">Fornecedor</a></li>
                <li id="" onmousemove="fornecedor()" onmouseleave="fornecedor2()">Teste<ul id="teste">
                    <li>Cadastrar asdsad</li>
                    <li>Listar sadasdsa</li>
                    <li>tetaejfeapo</li>
                </ul></li>
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
                    echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='login.html';</script>";
                }
                ?>

            </ul>
        </nav>
    </header>
</body>
<script>
    function fornecedor(){
            document.getElementById("teste").style.display = "block";
    }
    function fornecedor2(){
            document.getElementById("teste").style.display = "none";
    }
    </script>
</html>