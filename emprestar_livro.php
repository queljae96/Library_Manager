<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];
    $visualizar_livros = mysqli_query($conexao,"SELECT nome,autor FROM livros WHERE id_email='$logado' ");

    $id=$_GET["id"];
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
        <section>
            <h2>Emprestar livro</h2>
                
                <?php
                    $idLivro = array($id);
                    // $data=date("Y-m-d");
                 foreach($idLivro as $value) {
                    //     //$data_devolucao = date('Y-m-d', strtotime($value[1));
                        
                    echo "$value";}
                    //     $ver_livro = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email='$logado' AND id ='$value'");

                    //     while($valor = mysqli_fetch_array($ver_livro)){
                    //         $id2 = $valor['id'];
                    //         echo "$id2";
                    //         //$idLivro = array($id);
                    //         //header("Location: emprestar_livro.php?id=$idLivro");
                                                        
                    //     }
                        
                    //     // header("Location: visualizar.php?nome=$nome&turma=$turma");        
                    // } 
                ?>    
                
                <form action="" method="POST">
                        <!-- código para visualizar os livros cadastrados no banco de dados -->
                    <?php
        
                       
                        
                    ?>
                </form>
        </section>

    </main>


</body>
</html>