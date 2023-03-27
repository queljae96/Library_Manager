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
    $statusC = $_GET['statusC'];

    if(isset($_POST['cancelar'])){
        echo "<script>
            var confirmacao = confirm('Tem certeza que deseja cancelar a solicitação de compartilhamento de dados?');                        
        </script>";

        $c = "<script>document.write(confirmacao)</script>";

        if($c == true){
            $result = mysqli_query($conexao,"UPDATE cadastro_de_usuario SET compartilhamento_de_dados='null', id_compartilhamento = '0' WHERE email='$logado'");
            $delete_registro = mysqli_query($conexao,"DELETE FROM solicitar_compartilhamento WHERE id_email = '$logado' ");
            echo "<script>
                var alert = alert('Solicitação de compartilhamento cancelada com sucesso');                        
            </script>";
        }

        echo "<script>
                window.location = 'perfil_de_compartilhamento.php?statusC=false';
        </script>";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados compartilhados</title>
    <link rel="stylesheet" href="perfil.css">
    <link rel="icon" type="image/png" href="img/library (1).png">
    <link href="script_menu.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

    <main>
        <section>

            <h1>Perfil de compartilhamento</h1>
            <?php echo "<a href='compartilhar_dados.php?statusC=$statusC' class='solicitar'>solicitar compartilhamento</a>";?>

            <h3>Dados compartilhados comigo</h3>

            <?php
                if($statusC == "false"){
                    echo "<p class='mensagemC'>Você ainda não tem acesso a nenhum dado compartilhado, solicite o ompartilhamento para ter acesso aos dados de outra conta</p>";
                }
                
                if($statusC == "true"){
                    echo "<table>";
                    echo "<tr>";
                    echo "<td class='nome'><b>Nome</b></td>";
                    echo "<td class='email'><b>Email</b></td>";
                    $verIdC = mysqli_query($conexao,"SELECT id_compartilhamento FROM cadastro_de_usuario WHERE email = '$logado' ");
                    while ($user_data = mysqli_fetch_assoc ($verIdC)){
                        $idC = $user_data['id_compartilhamento'];
                        $verEmailC = mysqli_query($conexao,"SELECT email,nome FROM cadastro_de_usuario WHERE id = '$idC' ");
                        while ($user_data = mysqli_fetch_assoc ($verEmailC)){
                            $emailC = $user_data['email'];
                            $nomeC = $user_data['nome'];
                            
                            echo "<tr>";
                            echo "<td class='dado1'>$nomeC</td>";
                            echo "<td class='dado2'>$emailC</td>";
                            echo "<form  method='POST' >";
                            echo "<td class='t'><button type='submit' name='cancelar' class='lixeira'><i class='fa-sharp fa fa-trash'></i></button></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                }
            ?>

            <h3>Quem tem acesso aos meus dados?</h3>

            <?php
                
                $verMeuId = mysqli_query($conexao,"SELECT id FROM cadastro_de_usuario WHERE email = '$logado' ");
                while ($user_data = mysqli_fetch_assoc ($verMeuId)){

                    $meuId = $user_data['id'];
                    $verAcesso = mysqli_query($conexao,"SELECT id,email,nome FROM cadastro_de_usuario WHERE id_compartilhamento = '$meuId' ");

                    if(mysqli_num_rows($verAcesso)<1){
                        echo "<p class='mensagemC'>Ninguém está tendo acesso aos dados da sua conta</p>";
                    }else{
                        echo "<table>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td class='nome'><b>Nome</b></td>";
                        echo "<td class='email'><b>Email</b></td>";

                        while ($user_data = mysqli_fetch_assoc ($verAcesso)){
                            $emailAcesso = $user_data['email'];
                            $nomeAcesso = $user_data['nome'];
                            $idAcesso = $user_data['id'];
    
                            echo "<tr>";
                            echo "<td class='dado1'>$nomeAcesso</td>";
                            echo "<td class='dado2'>$emailAcesso</td>";
                            echo "<td><a class='lixeira' href='cancelarAcesso.php?email=$emailAcesso&statusC=$statusC' ><i class='fa-sharp fa fa-trash'></i></a></td>";
                            echo "</tr>";
    
                        }

                        echo "</tr>";
                        echo "</table>";

                    }

                    
                }
               
            ?>

        </section>
    </main>
</body>
</html>