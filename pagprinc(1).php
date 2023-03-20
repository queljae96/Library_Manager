<?php

    session_start();
    include_once('config.php');
    //print_r($_SESSION['email']);
    $logado = $_SESSION['email'];

    $verificar_status = mysqli_query($conexao,"SELECT email,statuss FROM status_login WHERE email='$logado' AND statuss='ativo' LIMIT 1");

    if (mysqli_num_rows($verificar_status)!=1){
        unset( $_SESSION['email']);
        unset ($_SESSION['senha']);
        header('Location: sair.php');
    }

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT nome,turma FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT nome,turma FROM usuarios ORDER BY id DESC";
    }

    $result=$conexao->query($sql);
    //print_r($result);

    $verificar_compartilhamento = mysqli_query($conexao,"SELECT compartilhamento_de_dados FROM cadastro_de_usuario WHERE email='$logado' AND compartilhamento_de_dados='ativo' LIMIT 1 ");
    
    if(isset($_POST ['submit']))
    {
        //print_r($_POST['nome']);
        include_once('config.php');
        $nome = $_POST ['nome'];
        $turma = $_POST ['turma'];
        $email = $_POST ['email'];
        $telefone = $_POST ['telefone'];

        $result = mysqli_query($conexao,"INSERT INTO usuarios (id_email,nome,turma,email,telefone) VALUES ('$logado','$nome','$turma','$email','$telefone')");
    }

    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library manager</title>
    <link rel="stylesheet" href="pagprinc.css">
    <link rel="icon" type="image/png" href="img/library (1).png">
    <link href="script_menu.js">
</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar"></input>
        <button class="lupa" onclick="searchData()">
            <img src="img/lupa (4).png">
        </button> 

        <button onclick="abrirModal()" class="openModal"><img src="img/barra-de-menu.png"></button>

    </header>

    <!-- Janela modal -->
    <div id="minhaModal" class="modal">
            <div class="modal-content">
                <span class="modal-close" onclick="fecharModal()">&times;</span>
                <br>
                <nav>
                    <a href="usuario_cadastro.php">Adicionar novo usuário</a>
                    <a href="livro.php">Livros</a>
                    <a href="">Solicitar relatório</a>
                    <a href="perfil_de_compartilhamento.php">dados compartilhados</a>
                    <a href="sair.php">Sair</a>
                </nav>
            </div>
    </div>

    <main>
            <section>
                <table>
                        <?php
                            echo "<tr>";
                            echo "<td class='nome'><b>Nome</b></td>";
                            echo "<td class='turma'><b>Turma</b></td>";
                                while ($user_data = mysqli_fetch_assoc ($result)) {
                                    echo "<tr>";
                                    echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                                    echo "<td class='dado2'>" . $user_data['turma'] . "</td>";
                                    echo "<td class='visualizar'><a  href='visualizar.php?nome=$user_data[nome]&turma=$user_data[turma]'><img src='img/visualizar (1).png'></td>";
                                    echo "</tr>";
                                }
                            echo "</tr>";
                        ?>
                </table>
            </section>

        

    </main>
    <footer>
        <div> <a class="bt" href="suporte (1).php">Suporte</a> </div>
    </footer>
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
        window.location = 'pagprinc(1).php?search='+search.value;
    }


    const menuHamburguer = document.querySelector('.menu-hamburguer');
    const menuHamburguerToggle = document.querySelector('.menu-hamburguer-toggle');
    
    menuHamburguerToggle.addEventListener('click');


    // Função para abrir a janela modal
            function abrirModal() {
                document.getElementById("minhaModal").style.display = "block";
            }

            // Função para fechar a janela modal
            function fecharModal() {
                document.getElementById("minhaModal").style.display = "none";
            }

</script>

</html>