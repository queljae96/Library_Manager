<?php
    session_start();
    include_once('config.php')
    //z$logado = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <title>Atualizar senha</title>
</head>

<body>
    <header>
        <a href="inicio (1).html"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <main>
        <section>
            <h1>Atualizar senha</h1> 

            <?php
                $chave=filter_input(INPUT_GET,'chavePD');
                //var_dump($chave);
                if((!$chave)){
                    print_r ( "<p class='erro'><b><font color=\"#FF0000\"> Erro: Link inválido! solicite um novo link para recuperar a senha </font></b></p>");
                }  else{
                        $select=mysqli_query($conexao,"SELECT recuperar_senha FROM cadastro_de_usuario WHERE recuperar_senha = '$chave' LIMIT 1");
                        //var_dump ($select);
                        if((mysqli_num_rows($select)!=0)){
                            if(isset($_POST ['submit'])){
                                //print_r($_POST['nome']);
                                $senha = $_POST ['senha'];
                                //print_r($verificar); 
                                if((!$senha)){ //verificar se o input está vazio
                                    echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Preencha todos os campos do formulário </font></b></p>";
                                }else { //adiciona os dados no banco de dados
                                    $link = 'NULL';
                                    $result = mysqli_query($conexao,"UPDATE cadastro_de_usuario SET senha='$senha',recuperar_senha='$link' WHERE recuperar_senha = '$chave' LIMIT 1");
                                    header('Location: fazer_login.php');

                                }
                            }
                        } 
                        if(isset($_POST ['submit'])){
                            echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Link inválido! solicite um novo link para atualizar a sua senha </font></b></p>";
                        }          
                    }

            ?>

            <form action="" method="POST">
                <input class="dados" type="password" name="senha" placeholder="Digite uma nova senha">
                <input class="btn" type="submit" name="submit" value="Enviar">
            </form>
            <a class="recuperar" href="fazer_login.php"><b>Fazer login</b></a>

        </section>
    </main>
</body>
</html>