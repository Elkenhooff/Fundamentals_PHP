<?php
session_start();
include("conectadb.php");
isset($_SESSION['nomecliente']) ? $nomecliente = $_SESSION['nomecliente'] : "";
$nomecliente = $_SESSION['nomecliente'];
$idcliente = $_SESSION['idcliente'];

$sql = "SELECT cli_imagem FROM cliente WHERE cli_id = '$idcliente';";
$retorno = mysqli_query($link,$sql);
$imagem = mysqli_fetch_array($retorno)[0];
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
            <ul>
                <li><a href="encomendas.php">Encomendas</a></li>
                <img src="<?=($imagem == null?'./img/noimg.jfif':'data:image/jpeg;base64,'.$imagem)?>" onclick="Perfil()" id="imag">
                <li><ul id="perfil">
                    <li class=""><a href="cliperfil.php">Perfil</a></li>
                    <li><a href="cliconfig.php">Configurações</a></li>
                    <li class=""><a href="logoutcliente.php">Sair</a></li>
                </ul>
</li>
            </li>
    <!-- Valida se a sessão de usuário está autenticada, senão retorne para login. -->
                <?php
                if ($nomecliente == null) {
                    echo "<script>window.alert('Cliente não autenticado');window.location.href='logincliente.html';</script>";
                }
                ?>
            </ul>
        </nav>
    </header>
</body>
<script>
    var perf = true;
    function Perfil(){
        if (perf){
            document.getElementById("perfil").classList.toggle('ativar');
            perf = false;
        }
        else{
            document.getElementById("perfil").classList.remove('ativar');
            perf = true;
        }
    }
    </script>
</html>