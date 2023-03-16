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
    <link rel="icon" type="image/png" href="img/Library.png">

</head>
<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <main>
        <section>
            <h2>Emprestar livro</h2>
                
                <?php

                    // verifica se os inputs estao marcados e os exibe na tela
                        if(isset($_POST['livro'])){
                            if(!empty($_POST['livro']))  { 
                                
                                    $result = array_map(null, $_POST['livro'], $_POST['datadev'],  $_POST['autor']);

                                    foreach($result as $value) {
                                        $data=date("Y-m-d");
                                        $data_devolucao = date('y/m/d', strtotime($value[1]));
                                        $add = mysqli_query($conexao,"INSERT INTO emprestar_livro (id_email,nome_pessoa,turma_pessoa,nome_livro,autor_livro,data_emprestimo,data_devolucao,statuss) VALUES ('$logado','$nome','$turma','$value[0]','$value[2]','$data','$data_devolucao','Pendente')");
                                        $delete1 = mysqli_query($conexao,"DELETE FROM emprestar_livro WHERE nome_livro='' ");
                                    }
                            }           
                            
                            echo "valores adicionados ";
                            header("Location: visualizar.php?nome=$nome&turma=$turma");        
                        } 
                ?>    
                
                <form action="" method="POST">
                        <!-- código para visualizar os livros cadastrados no banco de dados -->
                    <?php
                        echo "<button type='submit' value='Enviar' name='enviar'>Adicionar livro</button> ";                          
                        while($valorivro = mysqli_fetch_array($visualizar_livros)){
                            $valor = $valorivro['nome'];
                            $autor = $valorivro['autor'];

                            echo "<tr class='info'>";

                            echo "<td>";
                            echo "<input class='check' type='checkbox' name='livro[]' value='$valor' readonly>";
                            echo "</td>";
                            echo "<label class='nome'>$valor</label>";

                            echo "<td>";
                            echo "<input name='autor[]' value='$autor' class='autor' readonly>";
                            echo "</td>";

                            echo "<td>";
                            echo "<input type='date' name='datadev[]' value='' class='date'>";
                            echo "</td>";

                            echo "</tr>";
                            echo "<br>";
                        }
                    ?>
                </form>
        </section>

    </main>


</body>
</html>