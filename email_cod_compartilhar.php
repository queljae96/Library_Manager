
<?php

    include_once('config.php');

    // $chave=$_GET["chavePD"];
    $chaveC=$_GET["chaveC"];
    $statusC=$_GET["statusC"];
    $email1 = $_GET["email_destino"];
    $email2 = $_GET["email_solicitador"];
    $nome = $_GET["nome1"];
    $nome2 = $_GET["nome2"];

    $ver_nome1 = mysqli_query($conexao,"SELECT nome,email FROM cadastro_de_usuario WHERE email = '$email1' ");
    $ver_nome2 = mysqli_query($conexao,"SELECT nome,email FROM cadastro_de_usuario WHERE email = '$email2' ");


    require_once('./src/PHPMailer.php');
    require_once('./src/SMTP.php');
    require_once('./src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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
        $mail->addAddress($email1);
        // $mail->addAddress('quel03102004@gmail.com');

        
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8'; 
                $mail->Subject = 'Solicitação de compartilhamento de dados - Library Manager';
                $mail->Body = '<br> Olá, '.$nome.'<br><br>'.$nome2.' Está solicitando o compartilhamento de dados da sua conta Library. <br><br>Este é o código de compartilhamento<b> '.$chaveC.'</b><br> Se você não reconhece essa ação de solicitamento fique tranquilo(a) que seus dados não serão compartilhados, ignore e exclua este e-mail.<br><br>atenciosamente, equipe Library Manager.';
           
        
        if($mail->send()) {
            header("Location: codChave.php?statusC=$statusC&emailC=$email1");
            //print_r("email enviado com sucesso");
        }
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }