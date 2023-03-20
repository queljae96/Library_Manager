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
    <title>Dados compartilhados</title>
    <link rel="stylesheet" href="perfil.css">
    <link rel="icon" type="image/png" href="img/library (1).png">
    <link href="script_menu.js">
</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

    <main>
        <section>

            <h1>Perfil de compartilhamento</h1>
            <a href="compartilhar_dados.php" class="solicitar">solicitar compartilhamento</a>

            <h3>Dados compartilhados comigo</h3>

            <?php
                // while($user_data = mysqli_fetch_array($usuario)){
                //     echo "<tr>";
                //     echo "<td class='dado'><p> Nome: </p>". $user_data['nome'] . "</td>";
                //     echo "<td class='dado'><p> Turma: </p>" . $user_data['turma'] . "</td>";
                //     echo "<td class='dado'><p> E-mail: </p>" . $user_data['email'] . "</td>";
                //     echo "</tr>";
                // }
            ?>

            <h3>Quem tem acesso aos meus dados?</h3>


        </section>
    </main>
</body>
</html>