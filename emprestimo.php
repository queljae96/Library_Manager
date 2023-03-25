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
                                      
                    
                    // verifica se os inputs estao marcados e os exibe na tela
                       

                            if(!empty($_POST['livro']))  { 

                                $result = $_POST['livro'];
                               //global $result;

                                echo '<script>
                                window.onload = function(){ abrirModal(); };
                                </script>';

  
                                    
                                   
                                    
                            //}          
                        } 

                        if(isset($_POST['livro'])){
                            $sv = $_POST['livro'];
                            if(!empty($sv)){
                                $dataDevolucao = array ($_POST['dataDev']);
                                echo "kk34444kkk";
                            }}
                        //    }else{
                        //     // $sv = $_POST['livro'];
                        //     //     if(!empty($sv)){
                        //     //         $dataDevolucao = array ($_POST['dataDev']);
                        //     //         echo "kk34444kkk";
                        //     //     }
                        //    }

                        //function m(){
                            if(isset($_POST['enviarr'])){
                                $dataDevolucao = array ($_POST['dataDev']);
    
                            //     $data=date("Y-m-d");
    
                                 //$rr = array_map(null,$dataDevolucao, $result );
                                //foreach($rr as $cc){
                                    //if (!empty($r)){
                                        // foreach ($result as $valor) {
                                            if(isset($_POST['livro'])){
                                                echo "p";
                                           }
                                         //}

                                        
                                   //}
                                    // foreach($result as $livro){
                                    //     // $ver_livro = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' AND nome ='$livro'");
                                    //     // while($user = mysqli_fetch_array($ver_livro)){
                                    //     //     $autor = $user['autor'];
                                    //     //     $resultado = mysqli_query($conexao,"INSERT INTO emprestar_livro (id_email,nome_pessoa,turma_pessoa,nome_livro,autor_livro,data_emprestimo,data_devolucao,statuss) VALUES ('$logado','$nome','$turma','$livro','$autor','$data','$valorDevolucao','Pendenet')");
                                    //     header("Location: visualizar.php?nome=$nome&turma=$turma&d=$livro");        
                                    // }
                                //}
                                        
                                }
                            //}
                        //}
                    
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

        <?php
        
        echo "<div id='modal' class='modal' >";
        echo "     <div class='modal-content'>";
        echo "            <span class='fechar' >&times;</span>";
        echo "            <h2>Emprestar livro</h2>";
        echo "            <h4>Digite a data de devolução que deseja devolver cada livro</h4>";
        echo "<form action='' method='POST'>";
        echo "<button type='submit' value='Enviar' name='enviarr'>Enviar</button> ";     
        echo "<table>";
        echo "<tr>";
        echo "<td class='livroName'><b>Livro</b></td>";
        echo "<td class='autorName'><b>Autor</b></td>";
        echo "<td class='dataDev'><b>Data de devolução</b></td>";
        foreach($result as $value){
            $ver_livro = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' AND nome ='$value'");
            while($user_data = mysqli_fetch_array($ver_livro)){
                echo "<tr class='info'>";
                echo "<td><p class='dado1'>$value</p></td>"; 
                echo "<td><p class='dado2'>".$user_data['autor']."</p></td>";
                echo "<td><input class='dado3' type='date' name='dataDev[]' required></td>";
                echo "</tr>";
            } 
        }
        echo "</tr>";
        echo "</table>";
        echo "</form>";
        echo "     </div>";
        echo "</div>";
        
        ?>

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