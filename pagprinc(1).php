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
    // echo"$logado";
    //$sql = "SELECT * FROM usuarios WHERE id_email = '$logado' ";

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
    //print_r($verificar_compartilhamento);
    
    // if(mysqli_num_rows($verificar_compartilhamento) == 1){
    //     $mostrar_dados_compartilhados = mysqli_query($conexao,"SELECT * FROM conta_compartilhada WHERE email='$logado' AND compartilhamento_de_dados='ativo' LIMIT 1 ");
    // }
        
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

        


        <img class="user" src="img/do-utilizador.png" href=""></img>
    </header>

    <button class="menu-hamburguer-toggle" aria-label="Abrir menu hamburguer">
            <span class="menu-hamburguer-toggle-icon">
            <nav class="menu-hamburguer">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </nav>

            </span>

            
    </button>

    <main>
        <section>
            <div class="form_group">
                <p class="nome"><b>Nome</b></p>
                <p class="turma"><b>Turma</b></p>
            </div>

            <table>
                    <?php
                            while ($user_data = mysqli_fetch_assoc ($result)) {
                                echo "<tr>";
                                echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                                echo "<td class='dado2'>" . $user_data['turma'] . "</td>";
                                echo "<td class='visualizar'><a  href='visualizar.php?nome=$user_data[nome]&turma=$user_data[turma]'><img src='img/visualizar (1).png'></td>";
                                echo "</tr>";
                            }
                    ?>
            </table>
        </section>

        <div class="container">
            <div>
                <a href="usuario_cadastro.php">Adicionar novo usuário</a>
                <a href="livro.php">Livros</a>
                <a href="">Solicitar relatório</a>
                <a href="perfil_de_compartilhamento.php">dados compartilhados</a>
            </div>
        </div>

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


</script>

</html>