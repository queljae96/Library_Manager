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
    $sql = "SELECT * FROM livros WHERE id_email = '$logado' ";
    $result=$conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library manager</title>
    <link rel="stylesheet" href="livro.css">
    <link rel="icon" type="image/png" href="img/library (1).png">

</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar"></input>
        <button class="lupa">
            <img src="img/lupa (4).png">
        </button> 
    </header>

    <main>
        <div class="container">
            <a class="new_user" href="new_livro.php">Adicionar novo livro</a>
        </div>

        </div>

        <div class="form_group">
            <p class="nome"><b>Nome</b></p>
            <p class="turma"><b>Autor</b></p>
        </div>

        <table>
                <?php
                
                        while ($user_data = mysqli_fetch_assoc ($result)) {
                            echo "<tr>";
                            echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                            echo "<td class='dado2'>" . $user_data['autor'] . "</td>";
                            echo "</tr>";
                            
                        }

                ?>
        </table>
    </main>
    <footer>
        <div> <a class="bt" href="suporte (1).php">Suporte</a> </div>
    </footer>
</body>

</html>