<?php
session_start();
isset($_SESSION['nomeusuario']) ? $nomeusuario = $_SESSION['nomeusuario'] : "";
$nomecliente = $_SESSION['nomecliente'];

echo $nomecliente;
?>
