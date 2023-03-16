
<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];
    // echo "$logado"; 

    $nome=$_GET["nome"];
    $turma=$_GET["turma"];

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
    }
    else
    {
        $sql = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
    }

    if(!empty($nome and $turma)){
        
        $usuario = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");
        $contato = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");

        //print_r($result);
        $ver_livro = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");

    }

    

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar livro</title>
    <link rel="stylesheet" href="visualizar.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">


</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar"></input>
        <button class="lupa" onclick="searchData()">
            <img src="img/lupa (4).png">
        </button> 
    </header>

    <main>
        <section class="princ">
                <table>
                        <!-- exibe os dados do usuario cadastrado -->
                        <?php
                            while($user_data = mysqli_fetch_array($usuario)){
                                echo "<tr>";
                                echo "<td class='dado'><p> Nome: </p>". $user_data['nome'] . "</td>";
                                echo "<td class='dado'><p> Turma: </p>" . $user_data['turma'] . "</td>";
                                echo "<td class='dado'><p> E-mail: </p>" . $user_data['email'] . "</td>";
                                echo "<td class='dado'><p> Telefone: </p>" . $user_data['telefone'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                </table>

                <?php
                    if(isset($_POST['excluir'])){
                    //sleep(5);
                ?>

                    <script>
                        var confirmacao = confirm("Tem certeza que deseja excluir esse usuário?");
                        if (confirmacao == true) {

                            <?php
                                //sleep(5);
                                $delete_registro = mysqli_query($conexao,"DELETE FROM usuarios WHERE nome = '$nome' AND turma = '$turma' ");
                                //sleep(5);
                                //header("Location: pagprinc(1).php");
                            ?>
                            alert("usuário deletado com sucesso");
                            window.location = 'pagprinc(1).php';
                        } else {
                        }
                    </script>
                    
                <?php
                    }
                ?>
                
                <?php
                        echo"<form action='' method='POST'>";
                        echo "<a class='botao' href='emprestimo.php?nome=$nome&turma=$turma'>+Livro</a>";
                        while($usuario = mysqli_fetch_array($contato)){
                            $email = $usuario['email'];
                            echo "<a class='contato' href='entrar_em_contato.php?nome=$nome&turma=$turma&email=$email'>Entrar em contato</a>";
                        }
                        echo "<input type='submit' name='excluir' class='delete' value='Excluir usuário'></input>";
                        echo "</form>";
                ?>

                <?php

                        while($user_data = mysqli_fetch_array($ver_livro)){
                            $livro = $user_data['nome_livro'];
                            $datadev = $user_data['data_devolucao'];
                            $autor = $user_data['autor_livro'];
                            $status = $user_data['statuss'];

                            echo "<p id='livro_info'>".$user_data['data_emprestimo']."</p><br>";
                            echo "<p class='detalhe'>Nome do livro:</p>";
                            echo "<p class='autorName'>Autor:</p>";
                            echo "<p class='dataDev'>Data de devolução:</p>";
                            echo "<p class='status'>Status:</p>";


                            echo "<tr class='info'>";
                            echo "<td ><p class='infoName'>$livro</p></td>";
                            echo "<td ><p class='autor'>$autor</p></td>";
                            echo "<p class='devolucao'>$datadev</p>";
                            echo "<p class='statuss'>$status</p>";
                            echo "</tr>";
                        }
                ?>
                
        </section>

        <!-- <footer>
            oi
        </footer> -->
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
        window.location = 'visualizar.php?nome='$nome'&turma='$turma'&search='+search.value;
    }
</script>

</html>