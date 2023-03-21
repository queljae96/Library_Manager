
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

<!-- <?php
    // if(isset($_POST['status'])){
    //     while($user = mysqli_fetch_array($ver_livro)){
    //     $verStatus = $user['statuss'];
    //     $idStatus = $user['id'];
?>

            <script>

                var confirmacao = confirm("Tem certeza que deseja excluir esse usuário?");

                if (confirmacao == true) {
                    <?php
                        
                        // if($verStatus == 'Pendente'){
                        //     $update_status =  mysqli_query($conexao,"UPDATE emprestar_livro SET statuss = 'Devolvido' WHERE email='$logado' AND id='$idStatus' ");
                        // }else{
                        //     $update_status2 =  mysqli_query($conexao,"UPDATE emprestar_livro SET statuss = 'Pendente' WHERE email='$logado' AND id='$idStatus' ");
                        // }
                    ?>
                }
                                                    
            </script>
                    
<?php
    //   }
    // }
?> -->

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

    <div class="voltar">
        <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>
    </div>

    <main>
        <section class="princ">
                
                <div class="informacoes">
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
                </div>

                <?php
                    if(isset($_POST['excluir'])){
                    //sleep(5);
                ?>

                    <script>

                            var confirmacao = confirm("Tem certeza que deseja excluir esse usuário?");

                            if (confirmacao == true) {

                                 var nome = "<?php echo "$nome"; ?>";
                                 var turma = "<?php echo "$turma"; ?>";

                                 var link = "excluir_user.php?nome="+nome+"&turma="+encodeURIComponent(turma);
                                 window.location.href = link;

                            }
                                                    
                    </script>
                    
                <?php
                    }
                ?>
                
                <div class="botoes">
                    <?php
                            echo"<form action='' method='POST'>";
                            echo "<a class='botao' href='emprestimo.php?nome=$nome&turma=$turma'>+ Livro</a>";
                            while($usuario = mysqli_fetch_array($contato)){
                                $email = $usuario['email'];
                                echo "<a class='contato' href='entrar_em_contato.php?nome=$nome&turma=$turma&email=$email'>Entrar em contato</a>";
                            }
                            echo "<input type='submit' name='excluir' class='delete' value='Excluir usuário'></input>";
                            echo "</form>";
                    ?>
                </div>

                <section class="emprestimo">
                    <div>
                        <table>
                            <?php
                                    echo "<tr>";
                                    echo "<td class='livroName'><b>Livro</b></td>";
                                    echo "<td class='autor'><b>Autor</b></td>";
                                    echo "<td class='dataDev'><b>Data de devolução</b></td>";
                                    echo "<td class='statuss'><b>Status</b></td>";

                                    while($user_data = mysqli_fetch_array($ver_livro)){
                                        $livro = $user_data['nome_livro'];
                                        $datadev = $user_data['data_devolucao'];
                                        $autor = $user_data['autor_livro'];
                                        $status = $user_data['statuss'];

                    

                                        echo "<tr>";
                                        echo "<td class='livro_info'>".$user_data['data_emprestimo']."</td><br>";
                                        echo "</tr>";

                                        echo "<tr class='info'>";
                                        echo "<td ><p class='dado1'>$livro</p></td>";
                                        echo "<td ><p class='dado2'>$autor</p></td>";
                                        echo "<td class='dado1'>$datadev</td>";

                                        echo "<form action='' method='POST'>";
                                        if($status == 'Pendente'){
                                            echo "<td ><input type='submit' name='status' class='statusPendente' value='$status'></td>";
                                        }else{
                                            echo "<td ><input type='submit' name='status' class='statusDevolvido' value='$status'></td>";
                                        }
                                        echo "</form>";

                                        echo "</tr>";
                                    }
                                    echo "</tr>";
                            ?>
                        </table>
                    </div>
                </section>

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
        var nome = "<?php echo "$nome"; ?>";
        var turma = "<?php echo "$turma"; ?>";

        window.location = "visualizar.php?nome="+nome+"&turma="+turma+"&search="+search.value;
    }
</script>

</html>