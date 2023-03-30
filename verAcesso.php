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
    $nomeAcesso = $_GET['nome'];
    $idAcesso = $_GET['id'];
    $emailAcesso = $_GET['email'];

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

    <?php echo " <a class='volt' href='perfil_de_compartilhamento.php?statusC=$statusC.php'><img src='img/de-volta (1).png'></a>"; ?>

    <main>
        <section>

            <h1>Acesso aos meus dados</h1>

            <h3>Dados da conta</h3>

            <?php
                   
                        echo "<table>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td class='nome'><b>Nome</b></td>";
                        echo "<td class='email'><b>Email</b></td>";
                        echo "<td class='email'><b>Status</b></td>";

                                $ver_status = mysqli_query($conexao,"SELECT statuss FROM status_login WHERE email = '$emailAcesso' ");
                                
                                while ($user_data3 = mysqli_fetch_assoc ($ver_status)){

                                    $status = $user_data3['statuss'];
            
                                    echo "<tr>";
                                    echo "<td class='dado1'>$nomeAcesso</td>";
                                    echo "<td class='dado2'>$emailAcesso</td>";

                                    if($status == 'ativo'){
                                        echo "<td class='statusA'><b>$status</b></td>";
                                    }else{
                                        echo "<td class='statusI'><b>$status</b></td>";
                                    }

                                    echo "<td><a class='lixeira' href='cancelarAcesso.php?email=$emailAcesso&statusC=$statusC' ><i class='fa-sharp fa fa-trash'></i></a></td>";
                                    echo "</tr>";
                                }
            
                        echo "</tr>";
                        echo "</table>";
               
            ?>

            <h3>Permissões</h3>

            <?php 
            
                echo "<table>";
                echo "<table>";
                echo "<tr>";
                echo "<td class='nome'><b>Excluir livro</b></td>";
                echo "<td class='email'><b>Excluir usuário</b></td>";
                // echo "<td class='email'><b>Adicionar livros</b></td>";
                // echo "<td class='email'><b>Fazer empréstimos</b></td>";

                    
                        $ver_permissao = mysqli_query($conexao,"SELECT * FROM permissoes WHERE idAcesso = '$emailAcesso' ");
                        
                        while ($user_data3 = mysqli_fetch_assoc ($ver_permissao)){

                            $p1 = $user_data3['deleteLivro'];
                            $p2 = $user_data3['deleteUser'];
                            $p3 = $user_data3['addLivro'];
                            $p4 = $user_data3['emprestar'];

                            echo "<tr class='bottom'>";

                            if($p1 == 'negado'){

                                echo "<td class='pNegado'><a href='mudarPermissao.php?tipo=p1&sttAtual=$p1&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p1</b></a></td>";
                            }else{
                                echo "<td class='pAceito'><a href='mudarPermissao.php?tipo=p1&sttAtual=$p1&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p1</b></a></td>";
                            }
                            
                            if($p2 == 'negado'){

                                echo "<td class='pNegado'><a href='mudarPermissao.php?tipo=p2&sttAtual=$p2&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p2</b></a></td>";
                            }else{
                                echo "<td class='pAceito'><a href='mudarPermissao.php?tipo=p2&sttAtual=$p2&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p2</b></a></td>";
                            }

                            // if($p3 == 'negado'){


                            //     echo "<td class='pNegado'><a href='mudarPermissao.php?tipo=p3&sttAtual=$p3&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p3</b></a></td>";
                            // }else{
                            //     echo "<td class='pAceito'><a href='mudarPermissao.php?tipo=p3&sttAtual=$p3&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p3</b></a></td>";
                            // }

                            // if($p4 == 'negado'){


                            //     echo "<td class='pNegado'><a href='mudarPermissao.php?tipo=p4&sttAtual=$p4&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p4</b></a></td>";
                            // }else{
                            //     echo "<td class='pAceito'><a href='mudarPermissao.php?tipo=p4&sttAtual=$p4&nome=$nomeAcesso&email=$emailAcesso&id=$idAcesso&statusC=$statusC'><b>$p4</b></a></td>";
                            // }

                            echo "</tr>";
                        }

                echo "</tr>";
                echo "</table>";
            
            ?>

        </section>
    </main>
</body>
</html>