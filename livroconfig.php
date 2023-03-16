<?php

if(isset($_POST ['button']))
{
//   print_r($_POST['nome']);
    include_once('config.php');
    $nome = $_POST ['nome'];
    $email = $_POST ['autor'];

    $result = mysqli_query($conexao,"INSERT INTO novoBook (nome,autor) VALUES ('$nome','$autor')");
}

?>