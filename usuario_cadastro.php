<?php

    session_start();
    include_once('config.php');
    //print_r($_SESSION['email']);
    if((!isset($_SESSION['email'])== true) and (!isset($_SESSION['senha'])== true)){
        unset( $_SESSION['email']);
        unset ($_SESSION['senha']);
        header('Location: inicio (1).php');
    }
    $logado = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library manager</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/library (1).png">

</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

    <main>

            <section>

                <h1>Adicionar novo usuario</h1>

                <?php
                    if(isset($_POST ['submit']))
                    {
                        //print_r($_POST['nome']);
                        // include_once('config.php');
                        $nome = $_POST ['nome'];
                        $turma = $_POST ['turma'];
                        $email = $_POST ['email'];
                        $telefone = $_POST ['telefone'];

                        $verificar = mysqli_query($conexao,"SELECT * FROM usuarios WHERE  nome = '$nome' AND turma = '$turma' AND email = '$email' AND telefone = '$telefone'");

                            //print_r($verificar); 
                            if((!$nome) || (!$turma) || (!$email) || (!$telefone)){ //verificar se o input está vazio
                                echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Preencha todos os campos do formulário </font></b></p>";
                            }elseif(mysqli_num_rows($verificar)!=0){ //verificar se o email já está cadastrado
                                echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Este usuário já está cadastrado</font></b></p>";
                            }else{
                                $date = date("Y-m-d");
                                $result = mysqli_query($conexao,"INSERT INTO usuarios (id_email,nome,turma,email,telefone,data_add) VALUES ('$logado','$nome','$turma','$email','$telefone','$date')");
                                header('Location: pagprinc(1).php');
                            }
                    }
                ?>

                <form  method="POST" action="usuario_cadastro.php">
                    <input class="dados" type="text" name="nome" placeholder="Nome">
                    <input class="dados" type="text" name="turma" placeholder="Turma">
                    <input class="dados" type="text" name="email" placeholder="E-mail">
                    <input class="dados" type="text" name="telefone" placeholder="Telefone">

                    <input type="submit" name="submit" class="btn" src="google.com"></input>
                </form>
            </section>

    </main>
</body>
</html>