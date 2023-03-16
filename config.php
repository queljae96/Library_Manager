<?php
    header("Content-Type: text/html; charset=UTF-8");

    $dbhost = "localhost";
    $dbusername = "root"; //nome da conexao
    $dbpassword = "root"; // senha
    $dbname= "libraryManager"; //nome do banco de dados

    $conexao = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname); //fazendo a conexao do banco de dados
    // if(!$conexao){
    //   echo "erro";
    // }else{
    //   echo "conexao efetuada com sucesso";
    // }

?>