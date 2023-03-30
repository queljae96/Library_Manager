<?php

    session_start();
    include_once('config.php');
    $statusC = $_GET['statusC'];
    //print_r($_SESSION['email']);
    // if((!isset($_SESSION['email'])== true) and (!isset($_SESSION['senha'])== true)){
    //     unset( $_SESSION['email']);
    //     unset ($_SESSION['senha']);
    //     header('Location: inicio (1).php');
    // }
    $logado = $_SESSION['email'];
    $sql = "SELECT * FROM livros WHERE id_email = '$logado' ORDER BY id DESC";
    $result=$conexao->query($sql);
    $dado = $_GET['tipoDado'];

    if($statusC == "true"){
        $verificar_compartilhamento = mysqli_query($conexao,"SELECT compartilhamento_de_dados,id_compartilhamento FROM cadastro_de_usuario WHERE email='$logado' AND compartilhamento_de_dados='ativo' LIMIT 1 ");
        while ($user_data = mysqli_fetch_assoc ($verificar_compartilhamento)) {
            $idC = $user_data['id_compartilhamento'];
            $verificarC = mysqli_query($conexao,"SELECT * FROM cadastro_de_usuario WHERE id = '$idC' ");
            while ($user = mysqli_fetch_assoc ($verificarC)) {
                $emailC = $user['email'];
                $dadoC = mysqli_query($conexao,"SELECT * FROM livros WHERE id_email = '$emailC'");
            }
        }
    }

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM livros WHERE id_email = '$logado' AND autor LIKE '%$data%' or nome LIKE '%$data%'  ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT * FROM livros WHERE id_email = '$logado' ORDER BY id DESC";
    }
    $result=$conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library manager</title>
    <link rel="stylesheet" href="livro.css">
    <link rel="icon" type="image/png" href="img/library (1).png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
        <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar"></input>
        <button onclick="searchData()" class="lupa">
            <img src="img/lupa (4).png">
        </button> 
    </header>

    <main>

        <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

        <div class="container">
            <a class="new_user" href="new_livro.php">Adicionar novo livro</a>
        </div>

        <div class="info">
            <table>
                    <?php

                        if(mysqli_num_rows($result)==0 && $dadosCompartilhados == "false"){
                            echo "<p class='bv'>Ops você ainda não tem nenhum livro cadastrado no sitema...<br><a href='new_livro.php'><b>clique aqui</b></a> e cadastre um livro</p>";
                        }else{
                            // if(mysqli_num_rows($result)>1 || $dadosCompartilhados == "true"){
                                echo "<table>";
                                echo "<tr>";
                                echo "<td class='nome'><b>Livro</b></td>";
                                echo "<td class='autor'><b>Autor</b></td>";
                                echo "<td class='estoque'><b>Estoque</b></td>";
                            //}
                        }

                        if(mysqli_num_rows($result)!=0 ){
                                while ($user_data = mysqli_fetch_assoc ($result)) {
                                    $id = $user_data['id'];
                                    echo "<tr>";
                                    echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                                    echo "<td class='dado2'>" . $user_data['autor'] . "</td>";
                                    echo "<td class='dado3'>" . $user_data['estoque'] . "</td>";
                                    echo "<td class='lixeira'><a href='verificar_exclusao.php?id=$id&statusC=$statusC&tipoDado=$tipoDado''><i class='fa-sharp fa fa-trash' style='font-size:20px;'></i></a></td>";
                                    echo "</tr>";
                                }
                        }

                        if($statusC == "true"){

                            echo "<tr class='cCompartilhada'><td>Conta compartilhada</td></tr>";
                            while ($user_data = mysqli_fetch_assoc($dadoC)) {
                            echo "<tr>";
                            echo "<td class='dado1'>" . $user_data['nome'] . "</td>";
                            echo "<td class='dado2'>" . $user_data['autor'] . "</td>";
                            echo "<td class='dado3'>" . $user_data['estoque'] . "</td>";

                            if($dado == "compartilhado"){
                                    $usuarioAcesso = mysqli_query($conexao,"SELECT * FROM permissoes WHERE idAcesso = '$logado' AND deleteLivro = 'permitido' LIMIT 1");
    
                                    $contAcesso = mysqli_fetch_array($usuarioAcesso);
    
                                    if($contAcesso == 0){
                                        
                                    }else{
                                        echo "<td class='lixeira'><a href='verificar_exclusao.php?id=$id&statusC=$statusC&tipoDado=$tipoDado'><i class='fa-sharp fa fa-trash' style='font-size:20px;'></i></a></td>";
                                    }
                            }
                            echo "</tr>";
                            }
                        }
                        echo "</tr>";
                        echo "</table>";

                    ?>
            </table>
        </div>

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
        window.location = 'livro.php?search='+search.value;
    }


  const menuHamburguer = document.querySelector('.menu-hamburguer');
  const menuHamburguerToggle = document.querySelector('.menu-hamburguer-toggle');
  
  menuHamburguerToggle.addEventListener('click');


</script>

</html>