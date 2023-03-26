
<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];
    // echo "$logado"; 

    $nome=$_GET["nome"];
    $turma=$_GET["turma"];
    $statusC = $_GET["statusC"];

    if($statusC == "true"){
        $verificar_compartilhamento = mysqli_query($conexao,"SELECT compartilhamento_de_dados,id_compartilhamento FROM cadastro_de_usuario WHERE email='$logado' AND compartilhamento_de_dados='ativo' LIMIT 1 ");
        while ($user_data = mysqli_fetch_assoc ($verificar_compartilhamento)) {
            $idC = $user_data['id_compartilhamento'];
            $verificarC = mysqli_query($conexao,"SELECT * FROM cadastro_de_usuario WHERE id = '$idC' ");
            while ($user = mysqli_fetch_assoc ($verificarC)) {
                $emailC = $user['email'];
                //$dadoC = "SELECT * FROM emprestar_livro  WHERE id_email = '$emailC'";
            }
        }
    }

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];

        $sql = ("SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
    }
    else
    {
        $sql = ("SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
    }
    
    $result=$conexao->query($sql);

    if(!empty($nome and $turma)){
        
        if($statusC == "false"){
            $usuario = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");
            $contato = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");

            //print_r($result);
            $ver_livro = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
        }else{
            $usuario = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$emailC' OR id_email = '$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");
            $contato = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email='$emailC' OR id_email = '$logado' AND nome='$nome' AND turma='$turma' LIMIT 1");

            //print_r($result);
            $ver_livro = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
        }
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
                                 var statusC = "<?php echo "$statusC"; ?>";

                                 var link = "excluir_user.php?nome="+nome+"&turma="+encodeURIComponent(turma)+"&statusC="+encodeURIComponent(statusC);
                                 window.location.href = link;

                            }
                                                    
                    </script>
                    
                <?php
                    }
                ?>
                
                <div class="botoes">
                    <?php
                            echo"<form action='' method='POST'>";
                            echo "<a class='botao' href='emprestimo.php?nome=$nome&turma=$turma&statusC=$statusC'>+ Livro</a>";
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
                                        echo "<td class='livro_info'>".date('d/m/Y', strtotime($user_data['data_emprestimo']))."</td><br>";
                                        echo "</tr>";

                                        echo "<tr class='info'>";
                                        echo "<td ><p class='dado1'>$livro</p></td>";
                                        echo "<td ><p class='dado2'>$autor</p></td>";
                                        echo "<td class='dado1'>".date('d/m/Y', strtotime($datadev))."</td>";

                                        echo "<form action='' method='POST'>";
                                        if($status == 'Pendente'){
                                            echo "<td class='statusPendente' ><a  href='verificar_opcao.php?id=$user_data[id]&nome=$nome&turma=$turma&status=$status&statusC=$statusC'><b>$status</b></a></td>";
                                        }else{
                                            echo "<td class='statusDevolvido' ><a  href='verificar_opcao.php?id=$user_data[id]&nome=$nome&turma=$turma&status=$status&statusC=$statusC'><b>$status</b></a></td>";
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