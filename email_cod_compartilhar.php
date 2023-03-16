
<?php

    include_once('config.php');

    $nome=$_GET["nome"];
    $email_destino = $_GET["email_destino"];
    $email_solicitador = $_GET["email_solicitador"];

    require_once('./src/PHPMailer.php');
    require_once('./src/SMTP.php');
    require_once('./src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    $chave =  mysqli_query($conexao,"SELECT chave_compartilhada FROM solicitar_compartilhamento WHERE id_email='$email_solicitador'");

    while ($user_data = mysqli_fetch_assoc ($chave)) {

        $codChave = $user_data['chave_compartilhada'];
                             
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'suportelibrarymanager@gmail.com';
            $mail->Password = 'uvqaucmvrkcbxdct';
            $mail->Port = 587;

            $mail->setFrom('suportelibrarymanager@gmail.com');
            $mail->addAddress($email_destino);
            // $mail->addAddress('quel03102004@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Solicitação de acesso para compartilhar dados - Library Manager';
            $mail->Body =
            '<div style="background-color: rgb(255, 255, 255);">
                <p style="font-size: 18px;color:black;">Olá,<br>  '.$nome.' está solicitando o compartilhamento de dados de sua conta Libary Manager, este é o código para a aceitação do compartilhamento de dados</p>
                <p style="font-size: 40px;color:#284f82;">'
                    .$codChave.
                '</p>
                <p style="font-size: 18px;color:black;">Se você não deseja compartilhar seus dados com esta pessoa, ignore e exclua este e-mail.<br><br>atenciosamente, equipe Library Manager.</p>
            </div>';
            // $mail->AltBody = '';

            if($mail->send()) {
                header("Location:  codChave.php?emailDeDadosCompartilhados=$email_destino");
                // die();
                print_r("email enviado com sucesso");
            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }
?>