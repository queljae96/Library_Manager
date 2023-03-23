<?php
    session_start();
    include_once('config.php');

    $id = $_GET["id"];

    $delete_registro = mysqli_query($conexao,"DELETE FROM livros WHERE id = '$id' ");

    header("Location: livro.php");
?>