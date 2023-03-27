<?php
    session_start();
    $logado = $_SESSION['email'];
    include_once('config.php');

    $statusC = $_GET['statusC'];
    $email = $_GET['email'];

    require_once('./src/PHPMailer.php');
    require_once('./src/SMTP.php');
    require_once('./src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    echo "<script>
    var confirmacao = confirm('Tem certeza que deseja cancelar o acesso de dados para essa conta?');                        
    </script>";

    $c = "<script>document.write(confirmacao)</script>";

    if($c == true){

        $result = mysqli_query($conexao,"UPDATE cadastro_de_usuario SET compartilhamento_de_dados='null', id_compartilhamento = '0' WHERE email='$email'");
        $verDados = mysqli_query($conexao,"SELECT nome FROM cadastro_de_usuario WHERE email = '$email' ");
        $meuNome = mysqli_query($conexao,"SELECT nome FROM cadastro_de_usuario WHERE email = '$logado' ");

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
            $mail->CharSet = 'UTF-8'; 
            $mail->Subject = 'Cancelamento de acesso aos dados - Library Manager';

            while ($user_data = mysqli_fetch_assoc ($verDados)){
                while ($user_data2 = mysqli_fetch_assoc ($meuNome)){
                    $nomeD = $user_data['nome'];
                    $myNome = $user_data2['nome'];

                    $mail->Body = 'Olá, '.$nomeD.'<br><br>'.$myNome.' cancelou o acesso de dados da sua conta, apartir de agora você não terá mais acessoa aos dados dessa conta.<br>Você poderá solicitar o compartilhamento de dados novamente através da aba "Dados compartilhados" no nosso site.<br><br>atenciosamente, equipe Library Manager.';
                // $mail->AltBody = '';
                }
            }

            if($mail->send()) {
                echo "<script>
                    var alert = alert('O acesso aos dados foi cancelado com sucesso');  
                    window.location = 'perfil_de_compartilhamento.php?statusC=$statusC';                     
                </script>";


            }
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
           
    }

    // echo "<script>
    //     window.location = 'perfil_de_compartilhamento.php?statusC=false';
    // </script>";

?>