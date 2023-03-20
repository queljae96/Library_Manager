<?php

    session_start();
    $logado = $_SESSION['email'];
    include_once('config.php');
    unset( $_SESSION['email']);
    unset ($_SESSION['senha']);
    $update_status =  mysqli_query($conexao,"UPDATE status_login SET statuss = 'inativo' WHERE email='$logado' ");
    header('Location: inicio (1).php');
  
?>