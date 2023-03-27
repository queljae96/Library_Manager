
<?php

    session_start();
    include_once('config.php');
    //print_r($_SESSION['email']);
    if((!isset($_SESSION['email'])== true) and (!isset($_SESSION['senha'])== true)){
        unset( $_SESSION['email']);
        // unset ($_SESSION['senha']);
        header('Location: inicio (1).php');
    }
    $logado = $_SESSION['email'];
    $statusC = $_GET['statusC'];
    $emailC = $_GET['emailC'];
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Código de compartilhamento</title>
<link rel="stylesheet" href="formulario.css">
<link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>
    <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>
    <main>
        <section>
            <h2>Código de compartilhamento</h2>
            <p>Insira o código enviado para o e-mail em que foi solicitado o compartilhamento</p>

            <?php

                $numero = random_int(1000, 9999);
                if(isset($_POST ['submit']))
                {
                    $codigo = $_POST['chave'];
                    $verificarIdC = mysqli_query($conexao,"SELECT id FROM cadastro_de_usuario WHERE email = '$emailC' ");
                    $verificar_chave = mysqli_query($conexao,"SELECT chave_compartilhada FROM solicitar_compartilhamento WHERE id_email='$logado' AND chave_compartilhada='$codigo' ");

                    if(mysqli_num_rows($verificar_chave) != 1){ //adiciona os dados no banco de dados
                        echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Chave inválida.</font></b></p>";
                    }else{ 
                        $atualizar_chave = mysqli_query($conexao,"UPDATE solicitar_compartilhamento SET chave_compartilhada = 'null' WHERE id_email = '$logado' ");
                        while ($user_data = mysqli_fetch_assoc ($verificarIdC)){
                            $idC = $user_data['id'];

                            $ativar_compatilhamento_de_dados2 = mysqli_query($conexao,"UPDATE cadastro_de_usuario SET compartilhamento_de_dados = 'ativo',id_compartilhamento = '$idC' WHERE email='$logado' ");
                        }
                        header ("Location: perfil_de_compartilhamento.php?statusC=true");
                    }
                }
            ?>

            <?php
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
                <form action="" method="POST" >
                    <input type="number" name="chave" placeholder="Código de compartilhamento">

                    <button type="submit" name="submit" id="submit" class="compartilhar" >Enviar </button>
                    <button class="recuperar" name="cancelar" href="login.php"><b>Cancelar solicitação de compartilhamento</b></button>

                </form>
        </section>
    </main>
</body>

</html>