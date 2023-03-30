<?php
    session_start();
    include_once('config.php');

    $id = $_GET["id"];
    $statusC = $_GET['statusC'];
    $dado = $_GET['tipoDado'];

    $delete_registro = mysqli_query($conexao,"DELETE FROM livros WHERE id = '$id' ");

    header("Location: livro.php?statusC=$statusC&tipoDado=$dado");
?>