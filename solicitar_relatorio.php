<?php

    session_start();
    include_once('config.php');
    $logado = $_SESSION['email'];

    $livroDataMin = $_GET["livroDataMin"];
    $livroDataMax = $_GET["livroDataMax"];
    $usuarioDataMin = $_GET["usuarioDataMin"];
    $usuarioDataMax = $_GET["usuarioDataMax"];

    require_once('./src/PHPMailer.php');
    require_once('./src/SMTP.php');
    require_once('./src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $qtdUser = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email = '$logado' AND data_add BETWEEN '$usuarioDataMin' AND '$usuarioDataMax'  ");
    $qtdTotalE = mysqli_query($conexao,"SELECT DISTINCT id FROM emprestar_livro  WHERE id_email = '$logado' AND data_emprestimo BETWEEN '$usuarioDataMin' AND '$usuarioDataMax'  ");
    $qtdPEmprestimo = mysqli_query($conexao,"SELECT DISTINCT id_num FROM emprestar_livro WHERE id_email = '$logado' ");
    $qtdPendente = mysqli_query($conexao,"SELECT DISTINCT id_num FROM emprestar_livro WHERE id_email = '$logado' AND statuss='Pendente' ");

    $verNome = mysqli_query($conexao,"SELECT nome FROM cadastro_de_usuario WHERE email = '$logado' ");


    use Dompdf\Dompdf;

    require_once 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    while ($user_data = mysqli_fetch_assoc ($verNome)){
        
        $qtdUsuario = mysqli_num_rows($qtdUser);
        $qtdEmprestimo = mysqli_num_rows($qtdPEmprestimo);
        $qtdPendente = mysqli_num_rows($qtdPendente);
        $qtdTotalE = mysqli_num_rows($qtdTotalE);

        $nome = $user_data['nome'];

            $dompdf->loadHtml("

            
                <html>
                
                    <body>

                        <header class='h'><img src='http://localhost:8888/GITHUB/Library_Manager/img/barra-de-menu.png'></header>

                        <main>
                        
                            
                        
                        </main>
                        
                        <style>
                            header{
                                background-color: #284f82;
                            }

                            .logo{
                                width:50px;
                            }
                        </style>
                    
                    </body>
                
                </html>
            
            ");
        

            $dompdf->set_option('dafaultFont','sans');

            $dompdf->setPaper('A4','portrait');

            $dompdf->render();

            $dompdf->stream('relatorioLibrary');

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
                $mail->addAddress($logado);
                // $mail->addAddress('quel03102004@gmail.com');

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8'; 
                $mail->Subject = 'Relatório - Library Manager';
                $mail->Body = 'Olá, '.$nome.' <br><br>PDF do relatório que foi solicitado na sua conta library, agradecemos a preferencia <br>atenciosamente, equipe Library Manager. <br>'.$dompdf->stream().'';
                // $mail->AltBody = '';

                if($mail->send()) {
                    header("Location: msg.php");
                }
                } catch (Exception $e) {
                    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
                }
    }
?>

