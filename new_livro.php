<?php

    session_start();
    include_once('config.php');
    // print_r($_SESSION['email']);
    if((!isset($_SESSION['email'])== true)){
        unset( $_SESSION['email']);
        header('Location: livro.php');
    }
    $logado = $_SESSION['email'];
    $statusC = $_GET['statusC'];
    $dado = $_GET['tipoDado'];

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo livro</title>
    <link rel="stylesheet" href="livro_cadastro.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <main>
        <h2>Adicionar novo livro</h2>
        
        <?php
                    if(isset($_POST ['submit']))
                    {
                        //print_r($_POST['nome']);
                        include_once('config.php');
                        $nome = $_POST ['nome'];
                        $autor = $_POST ['autor'];
                        $estoque = $_POST ['estoque'];

                        $verificar = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' AND nome='$nome' AND autor='$autor'");

                        //print_r($verificar); 
                        if((!$nome) || (!$autor)){ //verificar se o input está vazio
                            echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Preencha todos os campos do formulário </font></b></p>";
                        }elseif(mysqli_num_rows($verificar)!=0){ //verificar se o email já está cadastrado
                            echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Este livro já está cadastrado no sistema </font></b></p>";
                        }else { //adiciona os dados no banco de dados
                            $result = mysqli_query($conexao,"INSERT INTO livros (id_email,nome,autor,estoque) VALUES ('$logado','$nome','$autor','$estoque')");
                            //echo "<p class='erro'><b><font color=\"#008000\"> Livro cadastrado com sucesso! </font></b></p>";
                            header("Location: livro.php?statusC=$statusC&tipoDado=$dado");
                        }
                        
                    }
        ?>

        <form action="" method="POST" >

            <input type="text" name="nome" placeholder="Nome do livro">
            <input type="text" name="autor" placeholder="Autor">
            <input type="number" name="estoque" placeholder="Estoque">
            <input type="submit" name="submit" id="submit"class="btn" ></input>
        </form>
        <?php echo "<a class='recuperar' href='livro.php?statusC=$statusC&tipoDado=$dado'><b>Voltar</b></a>"; ?>

    </main>


</body>
</html>