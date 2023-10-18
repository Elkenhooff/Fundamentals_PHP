<?php

#Testes para remover o erro "undefinied variable"
$soma = null;

#Captura o método post e define as varíaveis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $soma = $num1 + $num2;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular soma</title>
    <link rel="stylesheet" href="./global.css">
</head>

<body>
    <div class="main-content">
        <div class="formulario">
            <form action="pagina.php" method="POST">
                <label for="num1" class="label">Insira seu primeiro número</label>
                <br>
                <input type="number" name="num1" class="input" step="0.01" required>
                <br>
                <label for="num2" class="label">Insira seu segundo número</label>
                <br>
                <input type="number" name="num2" class="input" step="0.01" required>
                <br>
                <?php
                #Se soma não for null, mostre o label.
                #Caso seja null não faça nada.
                if ($soma != null)
                {
                    echo("<label class='label'>O resultado é $soma</label>");
                }
                ?>
                <br>
                <button type="submit" class="btn">Somar</button>
            </form>
        </div>
    </div>

</body>

</html>