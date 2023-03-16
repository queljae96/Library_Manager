<?php
    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];

    //echo "oi";

    $nome = $_GET["nome"];
    $turma = $_GET["turma"];

    $delete_registro = mysqli_query($conexao,"DELETE FROM usuarios WHERE nome = '$nome' AND turma = '$turma' ");
    $delete_registro2 = mysqli_query($conexao,"DELETE FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa = '$nome' AND turma_pessoa = '$turma' ");

    header("Location: pagprinc(1).php");
?>