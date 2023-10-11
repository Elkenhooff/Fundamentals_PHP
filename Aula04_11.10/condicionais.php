<?php

$var1 = "Pedro";
$var2 = "Richard";

if ($var1 == $var2)
{
    echo ("São as mesmas pessoas.");
}
else
{
    echo("Não são as mesmas pessoas.");
}

echo ("<br>");

if ($var1 === $var2)
{
    echo("Mesmo data type.");
}
else
{
    echo("Não são as mesma pessoas ou data type diferente.");
}

echo ("<br>");

##Operador Ternário##
echo ($var1 == $var2?"É igual":"É diferente");

?>