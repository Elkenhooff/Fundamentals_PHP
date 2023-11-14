<?php
include('cabecalholoja.php');
#Recebe o produto que o usuário quer favoritar
$id = $_GET['id'];
#Verifica se o usuário está logado
if (isset($idusuario)){
    $sql = "SELECT COUNT(fav_id) FROM favoritos WHERE fk_cli_id = $idusuario AND fk_pro_id = $id";
    $retorno = mysqli_query($link, $sql);

    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
        
        if ($cont == 0){
        $sql = "INSERT INTO favoritos (fk_cli_id, fk_pro_id) VALUES ($idusuario, $id)";
        mysqli_query($link, $sql);
        } else{
            $sql = "DELETE FROM favoritos WHERE fk_cli_id = $idusuario AND fk_pro_id = $id";
            mysqli_query($link, $sql);
        }
    }
} else{
    echo ("<script>window.alert('Faça login para favoritar');</script>");
    header("Location: loginclientes.php");
}
header("Location: verproduto.php?id=$id");
exit;
?>