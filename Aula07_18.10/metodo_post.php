<?php

#Usando o método POST (As informações NÃO são enviadas para a URL)
if (isset($_POST['login'])) {
    echo $_POST['login'];
}
if (isset($_POST['senha'])) {
    echo $_POST['senha'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método Post</title>
    <link rel="stylesheet" href="./global.css">
</head>

<body>
    <div class="main-content">
        <div class="formulario">
            <form action="metodo_get.php" method="GET">
                <input type="text" name="login" class="input" placeholder="Insira seu login">
                <br>
                <input type="password" name="senha" class="input" placeholder="Insira sua senha">
                <br>
                <button type="submit" class="btn">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>