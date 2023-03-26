<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];
    $visualizar_livros = mysqli_query($conexao,"SELECT nome,autor FROM livros WHERE id_email='$logado' ");

    $nome=$_GET["nome"];
    $turma=$_GET["turma"];
    $date = date('Y-m-d');
    $statusC = $_GET["statusC"];

    $livros = explode(',', $_GET['livros']);

    if(!empty($_POST['dataDev'])){
        $arr = array_map(null,$livros,$_POST["dataDev"]);
        foreach($arr as $value){

                $livro = $value[0];
                $valorDevolucao = date('Y-m-d', strtotime($value[1]));

                $visualizar_autor = mysqli_query($conexao,"SELECT * FROM livros WHERE nome = '$livro' AND id_email='$logado'  ");
                
                while($user = mysqli_fetch_array($visualizar_autor)){
                    $autor = $user['autor'];
                    $emprestar_livro = mysqli_query($conexao,"INSERT INTO emprestar_livro (id_email,nome_pessoa,turma_pessoa,nome_livro,autor_livro,data_emprestimo,data_devolucao,statuss) VALUES ('$logado','$nome','$turma','$livro','$autor','$date','$valorDevolucao','Pendente')");
                }
            
        }
       header("Location: visualizar.php?nome=$nome&turma=$turma&d=$livro&statusC=$statusC");           
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar livro</title>
    <link rel="stylesheet" href="previa.css">
    <!-- <link rel="stylesheet" href="emprestar.css"> -->
    <link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <main>
        <section>                
                <?php
                    echo "<h4>Digite a data de devolução que deseja devolver cada livro</h4>";
                    echo "<form action='' method='POST'>";
                    echo "<button type='submit' value='Enviar' name='enviarr' id='botao' >Enviar</button> ";     
                    echo "<table>";
                    echo "<tr>";
                    echo "<td class='livroName'><b>Livro</b></td>";
                    echo "<td class='autorName'><b>Autor</b></td>";
                    echo "<td class='dataDev'><b>Data de devolução</b></td>";

                    if (isset($_GET['livros'])) {
                        $livros = explode(',', $_GET['livros']);
                        foreach($livros as $value){
                            $ver_livro = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' AND nome ='$value'");
                            while($user_data = mysqli_fetch_array($ver_livro)){

                                $autor = $user_data['autor'];

                                echo "<tr class='info'>";
                                echo "<td><p class='dado1'>$value</p></td>"; 
                                echo "<td><p class='dado2' >".$user_data['autor']."</p></td>";
                                echo "<td><input class='dado3' type='date' name='dataDev[]' min='$date' required></td>";
                                echo "</tr>";
                            } 
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                    echo "</form>";
                ?>    
        </section>

    </main>


</body>
</html>