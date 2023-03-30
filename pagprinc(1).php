<?php

    session_start();
    include_once('config.php');
    // print_r($_SESSION['email']);
    $logado = $_SESSION['email'];

    if (isset($_GET['r'])) {
        $categorias = explode(',', $_GET['r']);
        
        // Loop para exibir as categorias
        foreach ($categorias as $categoria) {
            echo $categoria . '<br>';
        }
    }

    $verificar_status = mysqli_query($conexao,"SELECT email,statuss FROM status_login WHERE email='$logado' AND statuss='ativo' LIMIT 1");

    if (mysqli_num_rows($verificar_status)!=1){
        unset( $_SESSION['email']);
        unset ($_SESSION['senha']);
        header('Location: sair.php');
    }

    $verificar_compartilhamento = mysqli_query($conexao,"SELECT compartilhamento_de_dados,id_compartilhamento FROM cadastro_de_usuario WHERE email='$logado' AND compartilhamento_de_dados='ativo' LIMIT 1 ");
    if(mysqli_num_rows($verificar_compartilhamento)>=1){
        $dadosCompartilhados = "true";
        while ($user_data = mysqli_fetch_assoc ($verificar_compartilhamento)) {
            $idC = $user_data['id_compartilhamento'];
            $verificarC = mysqli_query($conexao,"SELECT * FROM cadastro_de_usuario WHERE id = '$idC' ");
            while ($user = mysqli_fetch_assoc ($verificarC)) {
                $emailC = $user['email'];
                $dadoC = mysqli_query($conexao,"SELECT id,nome,turma FROM usuarios WHERE id_email = '$emailC'");
            }
        }
    }else{
        $dadosCompartilhados = "false";
    }

    if($dadosCompartilhados == "true"){
        $tipoDado = "compartilhado";
    }else{
        $tipoDado = "meuDado";
    }


    if(!empty($_GET['search']))
    {       $d = $emailC;

            $data = $_GET['search'];
            $sql = "SELECT id,nome,turma FROM usuarios WHERE  id_email = '$logado' and id_email = '$emailC' AND id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";        
    }
    else
    {
        $sql = "SELECT id,nome,turma FROM usuarios WHERE id_email = '$logado' ORDER BY id DESC";
    }

    $result=$conexao->query($sql);
    //print_r($result);  
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
                    <?php echo "<a href='livro.php?tipoDado=$tipoDado?statusC=$dadosCompartilhados'>Livros</a>";?>
                    <?php echo"<a href='relatorio.php?statusC=$dadosCompartilhados'>Solicitar relatório</a>"; ?>
                    <?php echo "<a href='perfil_de_compartilhamento.php?statusC=$dadosCompartilhados'>Dados compartilhados</a>";?>
                    <a href="sair.php">Sair</a>
                </nav>
            </div>
    </div>

    <main>
            <section>
                
                <?php
                    
                    if(mysqli_num_rows($result)==0 && $dadosCompartilhados == "false"){
                        echo "<p class='bv'>Ops você ainda não tem nenhum usuário cadastrado no sitema...<br><a href='usuario_cadastro.php'><b>clique aqui</b></a> e cadastre um usuário</p>";
                    }else{
                        // if(mysqli_num_rows($result)>1 || $dadosCompartilhados == "true"){
                            echo "<table>";
                            echo "<tr>";
                            echo "<td class='nome'><b>Nome</b></td>";
                            echo "<td class='turma'><b>Turma</b></td>";
                        //}
                    }

                    
                    
                    if(mysqli_num_rows($result)!=0 ){
                        while ($user_data = mysqli_fetch_assoc ($result)) {
                            echo "<tr>";
                            echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                            echo "<td class='dado2'>" . $user_data['turma'] . "</td>";
                            echo "<td class='visualizar'><a  href='visualizar.php?nome=$user_data[nome]&turma=$user_data[turma]&statusC=$dadosCompartilhados&id=$user_data[id]&tipoDado=meuDado'><img src='img/visualizar (1).png'></td>";
                            echo "</tr>";
                        }
                    }
                        
                    if($dadosCompartilhados == "true"){
                        echo "<tr class='cCompartilhada'><td>Conta compartilhada</td></tr>";
                        while ($user_data = mysqli_fetch_assoc($dadoC)) {
                        echo "<tr>";
                        echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                        echo "<td class='dado2'>" . $user_data['turma'] . "</td>";
                        echo "<td class='visualizar'><a  href='visualizar.php?nome=$user_data[nome]&turma=$user_data[turma]&statusC=$dadosCompartilhados&id=$user_data[id]&tipoDado=compartilhado'><img src='img/visualizar (1).png'></td>";
                        echo "</tr>";
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                ?>
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