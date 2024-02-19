<?php
session_start();
include("conectadb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    #Coleta os dados inseridos no formulário da pagina 'logincliente.html'.
    $email = $_POST['emailcliente'];
    $senha = $_POST['senhacliente'];

    #Criação da SQL para verificar se os dados enviados consta no banco de dados para a validação da conta.
    $sql = "SELECT COUNT(cli_id) FROM cliente WHERE cli_email = '$email' AND cli_senha = '$senha';";
    #Envia a query para o banco de dados.
    $retorno = mysqli_query($link, $sql);

    #Pegar dados nas colunas da tabela.
    #$retorno = mysqli_fetch_array($retorno)[0];
    #OU
    while ($coluna = mysqli_fetch_array($retorno)){
        $contador = $coluna[0];
    }

    if ($contador < 1){
        #Envia um código em javascript que envia uma mensagem para o cliente.
        echo("<script>window.alert('Email ou senha invalidos.');</script>");
        #Envia o cliente para a página principal de login.
        #header("Location: logincliente.html"); #Envia tão rápido que nem aparece o windowalert :(
        #Ou
        echo("<script>window.location.href='logincliente.html';</script>");
    }
    else{
        #Passa a SQL exijindo apenas o ID e o Nome do cliente.
        $sql = "SELECT * FROM cliente WHERE cli_email = '$email' AND cli_senha = '$senha';";
        $retorno = mysqli_query($link, $sql);

        #Pega os valores da coluna 0 e 1 e insira eles em uma varíavel de sessão.
        while ($coluna = mysqli_fetch_array($retorno)){
            $_SESSION['idcliente'] = $coluna[0];
            $_SESSION['nomecliente'] = $coluna[1];
        }

        #Encaminha para pagina principal.
        echo("<script>window.location.href='encomendas.php';</script>");
    }
}
?>