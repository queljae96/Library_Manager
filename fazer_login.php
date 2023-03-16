<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">

    <title>Fazer login</title>
</head>

<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    
    <a class="volt" href="inicio (1).php"><img src="img/de-volta (1).png"></a>

    <main>
   
    <section>
        <h1>Fazer login</h1>
            <?php

                if(isset($_POST['submit'])){
                    //print_r("maior");
                    include_once('config.php');
                    $email=$_POST['email'];
                    $senha=$_POST['senha'];
                
                    $verificar = mysqli_query($conexao,"SELECT email,senha FROM cadastro_de_usuario WHERE email = '$email' AND senha = '$senha'");
                    $verificar_email = mysqli_query($conexao,"SELECT email,senha FROM cadastro_de_usuario WHERE email = '$email'");
                    //print_r($result); 
                
                        if((!$email) || (!$senha)){ //verificar se o input está vazio
                            echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Preencha todos os campos do formulário </font></b></p>";
                        }elseif(mysqli_num_rows($verificar_email)==0){//verificar se o email inserido já está cadastrado
                            echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Usuário inválido! Realize o cadastro para acessar o sistema </font></b></p>";
                        }elseif(mysqli_num_rows($verificar)==0){//verificar se a senha coincide com o email cadastrado
                            echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Verifique se você inseriu todas as informações corretamente </font></b></p>";
                        }else{
                            $_SESSION['email'] = $email;
                            $_SESSION['senha'] = $senha;
                            header("Location: pagprinc(1).php");
                        }
                }
        
            ?>

            <form action="" method="POST">
                <input class="dados" type="text" name="email" placeholder="Email">
                <input class="dados" type="password" name="senha" placeholder="Senha">
                <input class="btn" type="submit" name="submit" value="Enviar">
            </form>
            <a class="recuperar" href="recuperar_senha.php"><b>Esqueci a senha</b></a>
            <a class="recuperar" href="cadastro.php"><b>Cadastre-se</b></a>

    </section>

    </main>
</body>
</html>