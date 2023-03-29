<?php
    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];

	$nome = $_GET["nome"];
    $turma = $_GET["turma"];
	$statusC = $_GET["statusC"];
	$email = $_GET["email"];
    $id = $_GET["id"];

    require_once('./src/PHPMailer.php');
    require_once('./src/SMTP.php');
    require_once('./src/Exception.php');
                
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 ?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">

    <title>Entrar em contato</title>
</head>



<body>
    <?php
       echo " <header>
                <a href='visualizar.php?nome=$nome&turma=$turma&statusC=$statusC&id=$id'><img class='logo' src='img/2 (1).png' alt=''></a>
            </header>

            <div class='voltar'>
                <a class='volt' href='visualizar.php?nome=$nome&turma=$turma&statusC=$statusC&id=$id'><img src='img/de-volta (1).png'></a>
            </div>";
    ?>
    <main>
        
    <section>
        <h1>Entrar em contato</h1>

        <?php
            if(isset($_POST['submit'])){
            //    echo "botão foi clicado"."<br/>";
            //     echo  "Texto digitado: ".$texto_digitado;
                
                $texto_digitado = $_POST["email"];
                $mail = new PHPMailer(true);
                
                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'suportelibrarymanager@gmail.com';
                    $mail->Password = 'kylypphjcbdslvbo';
                    $mail->Port = 587;
                
                    $mail->setFrom('suportelibrarymanager@gmail.com');
                    $mail->addAddress($email);
                    // $mail->addAddress('quel03102004@gmail.com');
                
                    $mail->isHTML(true);
                    $mail->Subject = 'Contato - Library Manager';
                    $mail->Body = $texto_digitado;
                    // $mail->AltBody = '';
                    if($mail->send()) {
                        header("Location: visualizar.php?nome=$nome&turma=$turma&statusC=$statusC");   
                     }
                } catch (Exception $e) {
                    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
                }
            }
            ?>

        <?php
        
            echo "<p class='ctt'><b>Entrar em contato com:</b> $nome</p>"

        ?>
            
            <form action="" method="POST">
                <textarea type="text" name="email" class="campo_mail" placeholder="Digite a mensagem que deseja enviar a esse usuário"></textarea>
                <input class="btn" type="submit" name="submit" value="Enviar" href="email_contato.php">
            </form>

    </section>

    </main>
</body>
</html>