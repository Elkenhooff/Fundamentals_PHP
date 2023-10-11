<?php
####Exercício####

#Crie um código php que valide o alistamento militar obrigatório
#Obs: Lembrando a idade minima é 18 anos e gênero masculino

#Variaveis para armazenar a idade e o genero.
$genero = "M";
$idade = 19;


#Condição que verifica se o genero é masculino E também maior que 17 anos.
if ($genero === "M"  && $idade > 17){
    echo ("<h1>Bem vindo ao exercito</h1>");
}
#Condição que verifica se a pessoa é menor de idade
else if ($idade < 18){
    echo ("<h3>Não foi possível efetuar seu alistamento (menor de idade)");
}
#Caso não seja nenhuma das condições acima
else{
    echo ("<h3>Não é necessário o alistamente militar obrigatório caso você não seja do genero masculino.");
}


#Condição Ternária
echo ($genero === "M" && $idade > 17?"<h1>Bem vindo ao exército.</h1>":"<h3>Você não possuí os requisitos para entrar no exército.<h3>");

?>


