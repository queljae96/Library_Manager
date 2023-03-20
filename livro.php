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
    $sql = "SELECT * FROM livros WHERE id_email = '$logado' ORDER BY id DESC";
    $result=$conexao->query($sql);

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT autor,nome,estoque FROM livros WHERE autor LIKE '%$data%' or nome LIKE '%$data%'  ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT nome,autor,estoque FROM livros ORDER BY id DESC";
    }
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
        <button onclick="searchData()" class="lupa">
            <img src="img/lupa (4).png">
        </button> 
    </header>

    <main>

        <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

        <div class="container">
            <a class="new_user" href="new_livro.php">Adicionar novo livro</a>
        </div>

        <div class="info">
            <table>
                    <?php
                        echo "<tr>";
                        echo "<td class='nome'><b>Nome</b></td>";
                        echo "<td class='autor'><b>Autor</b></td>";
                        echo "<td class='estoque'><b>Estoque</b></td>";
                                while ($user_data = mysqli_fetch_assoc ($result)) {
                                    echo "<tr>";
                                    echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                                    echo "<td class='dado2'>" . $user_data['autor'] . "</td>";
                                    echo "<td class='dado3'>" . $user_data['estoque'] . "</td>";
                                    echo "<td><button type='submit' name='submit' class='excluir'><img src='img/lixeira (1).png'</button></td>";
                                    echo "</tr>";
                                }
                        echo "</tr>";
                    ?>
            </table>
        </div>

    </main>
</body>

<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'livro.php?search='+search.value;
    }


  const menuHamburguer = document.querySelector('.menu-hamburguer');
  const menuHamburguerToggle = document.querySelector('.menu-hamburguer-toggle');
  
  menuHamburguerToggle.addEventListener('click');


</script>

</html>