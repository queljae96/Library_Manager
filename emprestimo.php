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
    $visualizar_livros = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' ");
    
    $statusC = $_GET["statusC"];
    $nome=$_GET["nome"];
    $turma=$_GET["turma"];

    if(!empty($nome and $turma)){

    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar livro</title>
    <link rel="stylesheet" href="emprestar.css">
    <!-- <link rel="stylesheet" href="emprestar.css"> -->
    <link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <?php echo "<a class='volt' href='visualizar.php?nome=$nome&turma=$turma&statusC=$statusC'><img src='img/de-volta (1).png'></a>"?>

    <main>
        <section >
            <h2>Emprestar livro</h2>
            <h4>Selecione os livros que deseja emprestar</h4>
                <?php        
                        if(!empty($_POST['livro']))  { 

                            $result = $_POST['livro'];

                            $livros = implode(',', $result);

                            // Adiciona o valor ao link
                            $link = 'previa_de_livros.php?nome='.$nome.'&turma='.$turma.'&livros='. urlencode($livros).'&statusC='.$statusC;
                            header ("Location: $link");

                        }
                ?>  

                    <form action="" method="POST">
                            <!-- código para visualizar os livros cadastrados no banco de dados -->
                        <?php
                                echo "<button type='submit' value='Enviar' name='enviar'>Enviar</button> ";
                                echo "<table>";
                                echo "<tr>";
                                echo "<td class='nome'><b>Nome</b></td>";
                                echo "<td class='autor'><b>Autor</b></td>";   
                                echo "<td class='estoque'><b>Estoque</b></td>"; 

                                while($valorivro = mysqli_fetch_array($visualizar_livros)){
                                    $valor = $valorivro['nome'];
                                    $autor = $valorivro['autor'];
                                    $estoque = $valorivro['estoque'];

                                    echo "<tr class='info'>";

                                    echo "<td class='dado1'><input class='check' type='checkbox' name='livro[]' value='$valor' readonly>$valor</td>";
                                    echo "<td class='dado2'>$autor</td>";
                                    echo "<td class='dado3'>$estoque</td>";

                                    echo "</tr>";
                                    echo "<br>";
                                }
                                echo "</table>";
                                echo "</tr>";
                        ?>
                    </form>

        </section>
    </main>
</body>

</html>