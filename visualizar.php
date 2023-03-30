
<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];
    // echo "$logado"; 

    $nome=$_GET["nome"];
    $turma=$_GET["turma"];
    $statusC = $_GET["statusC"];
    $id = $_GET["id"];
    $dado = $_GET["tipoDado"];

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
            $usuario = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id = '$id' LIMIT 1");
            $contato = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id = '$id' LIMIT 1");

            //print_r($result);
            $ver_livro = mysqli_query($conexao,"SELECT * FROM emprestar_livro WHERE id_email='$logado' AND nome_pessoa='$nome' AND turma_pessoa='$turma' ORDER BY id DESC");
        }else{
            $usuario = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id = '$id' LIMIT 1");
            $contato = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id = '$id' LIMIT 1");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

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
                    <table class="dados_usuario">
                            <!-- exibe os dados do usuario cadastrado -->
                            <?php
                                while($user_data = mysqli_fetch_array($usuario)){
                                    echo "<tr>";
                                    echo "<th class='info1'><b>Nome:</b>". $user_data['nome'] . "</th><br>";
                                    echo "<th class='info1'><b>Turma:</b>" . $user_data['turma'] . "</th><br>";
                                    echo "<th class='info1'> <b>E-mail:</b>" . $user_data['email'] . "</th><br>";
                                    echo "<th class='info1'><b>Telefone:</b>" . $user_data['telefone'] . "</th>";
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
                                 var id = "<?php echo "$id"; ?>";

                                 var link = "excluir_user.php?nome="+nome+"&turma="+encodeURIComponent(turma)+"&statusC="+encodeURIComponent(statusC)+"&id="+encodeURIComponent(id);
                                 window.location.href = link;

                            }
                                                    
                    </script>
                    
                <?php
                    }
                ?>

                <div class="botoes">
                    <?php
                            echo"<form action='' method='POST'>";
                            echo "<a class='botao' href='emprestimo.php?nome=$nome&turma=$turma&statusC=$statusC&id=$id'>+ Livro</a>";
                            while($usuario = mysqli_fetch_array($contato)){
                                $email = $usuario['email'];
                                echo "<a class='contato' href='entrar_em_contato.php?nome=$nome&turma=$turma&email=$email&id=$id&statusC=$statusC'>Entrar em contato</a>";
                            }

                            if($dado == "compartilhado"){
                                if($statusC == "true"){
                                    $usuarioAcesso = mysqli_query($conexao,"SELECT * FROM permissoes WHERE idAcesso = '$logado' AND deleteLivro = 'permitido' LIMIT 1");
    
                                    $contAcesso = mysqli_fetch_array($usuarioAcesso);
    
                                    if($contAcesso == 0){
                                        
                                    }else{
                                        echo "<input type='submit' name='excluir' class='delete' value='Excluir usuário'></input>";
                                    }
    
                                }else{
                                    echo "<input type='submit' name='excluir' class='delete' value='Excluir usuário'></input>";
                                }
                            }else{
                                echo "<input type='submit' name='excluir' class='delete' value='Excluir usuário'></input>";
                            }

                            echo "</form>";
                    ?>
                </div>

                <section class="emprestimo">
                    <div>
                        <?php 
                                if(mysqli_num_rows($ver_livro) == 0){
                                    echo "<p class='bv'><b>Este usuário ainda não pegou nenhum livro emprestado</b></p>";
                                }else{
                                    echo "<table class='livro'>";
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
                                        $idEmprestimo = $user_data['id'];
                                        $idLivro = $user_data['id_livro'];


                                        echo "<tr>";
                                        echo "<td class='livro_info'>".date('d/m/Y', strtotime($user_data['data_emprestimo']))."</td><br>";
                                        echo "</tr>";

                                        echo "<tr class='info'>";
                                        echo "<td ><p class='dado1'>$livro</p></td>";
                                        echo "<td ><p class='dado2'>$autor</p></td>";
                                        echo "<td class='dado3'>".date('d/m/Y', strtotime($datadev))."</td>";

                                        echo "<form action='' method='POST'>";
                                        if($status == 'Pendente'){
                                            echo "<td class='statusPendente' ><a href='mudar_status.php?idEmprestimo=$idEmprestimo&nome=$nome&turma=$turma&statusC=$statusC&id=$id&status=$status&id_livro=$idLivro'><b>$status</b></a></td>";
                                        }else{
                                            echo "<td class='statusDevolvido'><a href='mudar_status.php?idEmprestimo=$idEmprestimo&nome=$nome&turma=$turma&statusC=$statusC&id=$id&status=$status&id_livro=$idLivro'><b>$status</b></a></td>";
                                        }
                                        echo "</form>";
                                        echo "<td class='lixo'><a href='excluir_registro.php?idLivro=$idLivro&nome=$nome&turma=$turma&statusC=$statusC&id=$id&status=$status'><i class='fa-sharp fa fa-trash'></i></a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tr>";
                                    echo "</table>";
                                }     
                            ?>
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