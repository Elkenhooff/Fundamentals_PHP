<?php

#Inicia a conexão com o banco de dados
include("conectadb.php");

#Coleta de Variáveis via formulário de html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    #Trim no nome para remover os espaços em branco (no começo e no final do campo)
    $nome = trim($nome);

    #Validando a senha
    #Expressão regular para verificar se a senha contém apenas letras, números e caracteres especiais permitidos
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()-_+=]*$/', $senha)) {
        echo ("<script>window.alert('Por favor informe que contém caracteres especiais permitidos');</script>");
        echo ("<script>window.location.href='cadastrousuario.php';</script>");
    } else {
        #Passando instruções SQL para o banco
        #Validando se o usuário existe
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)) {
            $cont = $tbl[0];
        }

        #Verificação se o usuario existe, se existe = 1, se não = 0.
        if ($cont == 1) {
            echo ("<script>window.alert('Usuário Já Cadastrado!');</script>");
        } else {
            #Verificação se o nome é vazio, caso a pessoa insira somente espaço (SPACEBAR) no campo usuário
            if ($nome == "") {
                echo ("<script>window.alert('Por favor preencha os campos corretamente');</script>");
                echo ("<script>window.location.href='cadastrousuario.php';</script>");
            }
            #Se não for vazio:
            else {
                $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo) VALUES('$nome', '$senha', 'n')";
                mysqli_query($link, $sql);
                echo ("<script>window.alert('Usuário Cadastrado');</script>");
                echo ("<script>window.location.href='cadastrousuario.php';</script>");
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>

<body>
    <div class="main-content">
        <form action="cadastrousuario.php" method="post">
            <input type="text" name="nome" id="nome" placeholder="Nome do Usuário" required>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <span id="MostrarSenha" class="MostrarSenha" onclick="MostrarSenha()">👀</span>
            <br>
            <br>
            <input type="submit" name="cadastro" id="cadastro" placeholder="Cadastrar">
        </form>
    </div>

</body>

<script>
    function MostrarSenha(){
        var senhaInput = document.getElementById("senha");
        var senhaIcone = document.getElementById("MostrarSenha");

        if (senhaInput.type === "password"){
            senhaInput.type = "text";
            senhaIcone.textContent = "🙈";
        }
        else{
            senhaInput.type = "password";
            senhaIcone.textContent = "👀";
        }
    }
</script>
</html>