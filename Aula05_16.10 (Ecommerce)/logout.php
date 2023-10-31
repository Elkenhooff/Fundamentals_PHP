<?php
session_start(); #Inicia a sessão caso não esteja iniciada.

session_destroy(); #Destroí a sessão atual

header("Location: login.php"); #Redireciona o usuário para a página de login

?>