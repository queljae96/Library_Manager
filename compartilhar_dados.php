
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compartilhar dados</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <?php echo "<a href='perfil_de_compartilhamento.php?statusC=$statusC'><img class='logo' src='img/2 (1).png' ></a>"; ?>
    </header>

    <?php echo "<a class='volt' href='perfil_de_compartilhamento.php?statusC=$statusC'><img src='img/de-volta (1).png' ></a>"; ?>

    <main>

        <section>

            <h2>Solicitar compartilhamento de dados</h2>

            <p>Insira o e-mail em que deseja solicitar o compartilhamento de dados</p>

            <?php

                $numero = random_int(1000, 9999);

                if(isset($_POST ['submit']))
                {
                    $email_destino = $_POST['email'];

                    $verificar = mysqli_query($conexao,"SELECT nome,email FROM cadastro_de_usuario WHERE email = '$email_destino' ");
                    $verificar_chave = mysqli_query($conexao,"SELECT compartilhamento_de_dados FROM cadastro_de_usuario WHERE email='$logado' AND compartilhamento_de_dados = 'null' LIMIT 1 ");
                    $ver_nome2 = mysqli_query($conexao,"SELECT nome,email FROM cadastro_de_usuario WHERE email = '$logado' ");
                
                    if(mysqli_num_rows($verificar) != 1){ //adiciona os dados no banco de dados
                         echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Este usuário não está cadastrado.</font></b></p>";
                    }else if(mysqli_num_rows($verificar_chave) == 1){

                            while ($user1 = mysqli_fetch_assoc ($verificar)) {
                                while ($user2 = mysqli_fetch_assoc ($ver_nome2)) {
                                    
                                    $nome1=$user1['nome'];
                                    $nome2=$user2['nome'];

                                    $result = mysqli_query($conexao,"INSERT INTO solicitar_compartilhamento (id_email,email_dado_compartilhado,chave_compartilhada) VALUES ('$logado','$email_destino','$numero')");
                                    $link = "email_cod_compartilhar.php?email_destino=$email_destino&email_solicitador=$logado&statusC=$statusC&chaveC=$numero&nome1=$nome1&nome2=$nome2";
                                    header("Location: $link");
                        
                                    echo "<p class='erro'><b><font color=\"#008000\"> Usuário cadastrado com sucesso! </font></b></p>";
                            
                                }
                            }
                    }else{
                            echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Você não pode solicitar o compartilhamento de dados pois você já está utilizando essa função. </font></b></p>";
                    }
                }
            ?>


                <form action="" method="POST" >
                    <input type="text" name="email" placeholder="E-mail">

                    <button type="submit" name="submit" id="submit" class="compartilhar" >Solicitar compartilhamento </button>
                    <button class="recuperar" name="cancelar" ><b>Cancelar solicitação de compartilhamento</b></button>

                </form>

        </section>

    </main>
</body>
</html>