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
    $visualizar_livros = mysqli_query($conexao,"SELECT nome,autor FROM livros WHERE id_email='$logado' ");
    
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

    <main>
        <section >
            <h2>Emprestar livro</h2>
                
                <?php        
                    
                    
                        if(!empty($_POST['livro']))  { 

                            $result = $_POST['livro'];

                            $livros = implode(',', $result);

                            // Adiciona o valor ao link
                            $link = 'previa_de_livros.php?nome='.$nome.'&turma='.$turma.'&livros='. urlencode($livros).'&statusC='.$statusC;
                            header ("Location: $link");

                        }
                        
                        
                        
                    //$resultado = mysqli_query($conexao,"INSERT INTO emprestar_livro (id_email,nome_pessoa,turma_pessoa,nome_livro,autor_livro,data_emprestimo,data_devolucao,statuss) VALUES ('$logado','$nome','$turma','$livro','$autor','$data','$valorDevolucao','Pendenet')");
                    //     header("Location: visualizar.php?nome=$nome&turma=$turma&d=$livro");        
                    
                ?>  
                
                    <form action="" method="POST">
                            <!-- código para visualizar os livros cadastrados no banco de dados -->
                        <?php
                            echo "<div id='corpo'>" ;                    
                                echo "<button type='submit' value='Enviar' name='enviar'>Enviar</button> ";     
                                while($valorivro = mysqli_fetch_array($visualizar_livros)){
                                    $valor = $valorivro['nome'];
                                    $autor = $valorivro['autor'];

                                    echo "<tr class='info'>";
                                    echo "<input class='check' type='checkbox' name='livro[]' value='$valor' readonly>";
                                    echo "<label class='nome'>$valor</label>";

                                    echo "<td>";
                                    echo "</td>";
                                    echo "<label class='nome'>$autor</label>";

                                    echo "</tr>";
                                    echo "<br>";
                                }
                            echo "</div>";
                        ?>
                    </form>

        </section>
    </main>
</body>

<script>
    function abrirModal() {
        var modal = document.getElementById("modal");
        var secao = document.getElementById("corpo");

        modal.style.display = "block";
    }

    var botaoFechar = document.getElementsByClassName("fechar")[0];
        botaoFechar.onclick = function() {
        modal.style.display = "none"; /* esconde a janela modal */
    }

</script>

</html>