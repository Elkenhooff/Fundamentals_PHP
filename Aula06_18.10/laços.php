<?php

#Laço de repetição (While)
$numero = 0;

#Enquanto '$numero' for menor que 10
while ($numero < 10){
    #Mostre '$numero' + 1, porém com espaço (' ') entre os números
    echo ($numero++ . " ");
}

#Quebra de linha para mostrar o código linha por linha no site.
echo ("<br>");

#Switch
$variavel = "Mulher";
switch ($variavel){
    #Caso '$variavel' seja igual a 'Homem'.
    case "Homem":
        echo ("Bem vindo ao exército");
        break;
    #Caso '$variavel' seja igual a 'homem'.
    case "homem":
        echo ("Bem vindo ao exército");
        break;
    #Caso '$variavel' seja igual a 'Mulher'.
    case "Mulher";
        echo ("Mulher não precisa se canditatar ao alistamento obrigatório");
        break;
    #Default (padrão). Caso nenhuma das opções acima aconteça, faça:
    default:
        echo ("Por favor insira somente os valores ('Homem' ou 'Mulher')");
        break;
}

echo ("<br>");

#Do While
$variavel1 = 4;
do{
    echo $variavel1++;
} while ($variavel1 <= 10);

echo ("<br>");

#For
#('$i' recebe 0; enquanto '$i' for menor que < 20; '$i' auto-incrementa 1)
for ($i = 0; $i < 20; $i++){
    #Mostre o valor de $i
    echo ($i);
}

?>