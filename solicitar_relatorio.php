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

    use Dompdf\Dompdf;

    require_once 'dompdf/autoload.inc.php';

    $qtdUser = mysqli_query($conexao,"SELECT * FROM usuarios WHERE id_email = '$logado' AND data_add BETWEEN '$usuarioDataMin' AND '$usuarioDataMax'  ");
    $qtdTotalE = mysqli_query($conexao,"SELECT DISTINCT id FROM emprestar_livro  WHERE id_email = '$logado' AND data_emprestimo BETWEEN '$livroDataMin' AND '$livroDataMax'  ");
    $qtdPEmprestimo = mysqli_query($conexao,"SELECT DISTINCT id_num FROM emprestar_livro WHERE id_email = '$logado' AND data_emprestimo BETWEEN '$livroDataMin' AND '$livroDataMax' ");
    $qtdPendente = mysqli_query($conexao,"SELECT DISTINCT id_num FROM emprestar_livro WHERE id_email = '$logado' AND statuss='Pendente' AND data_emprestimo BETWEEN '$livroDataMin' AND '$livroDataMax'");

    $verNome = mysqli_query($conexao,"SELECT nome FROM cadastro_de_usuario WHERE email = '$logado' ");


        
        $qtdUsuario = mysqli_num_rows($qtdUser);
        $qtdEmprestimo = mysqli_num_rows($qtdPEmprestimo);
        $qtdPendente = mysqli_num_rows($qtdPendente);
        $qtdTotalE = mysqli_num_rows($qtdTotalE);

        $d1 = date('d/m/Y', strtotime($usuarioDataMin));
        $d2 = date('d/m/Y', strtotime($usuarioDataMax));
        $d3 = date('d/m/Y', strtotime($livroDataMin));
        $d4 = date('d/m/Y', strtotime($livroDataMax));
        
        while ($user_data = mysqli_fetch_assoc ($verNome)){

            $nome = $user_data['nome'];
        
            $dompdf = new Dompdf();
            $dompdf->loadHtml("

            
                <html>
                
                    <body>

                        <header class='h'></header>

                        <main>
                        
                            <h1>Relatório - Library Manager</h1>

                            <h3>Livros:</h3>

                            <h5>No período de $d1 até $d2: </h5>

                            <p>Houveram  $qtdUsuario novo(s) usuário(s) cadastrado(s) na conta -------------------------</p>

                            <p>-----------------------------------------------------------------------------------------</p>

                            <h5>No período de $d3 até $d4: </h5>

                            <p>Houveram $qtdEmprestimo usuário(s) que pegaram livros emprestados ------------------------<br>
                            <br>No total são $qtdTotalE empréstimo(s) de livro(s) ---------------------------------------------<br> 
                            <br>$qtdPendente aluno(s) continua(m) com o livro pendente a ser entregue -----------------------</p>

                        </main>

                        <footer class='h'></footer>

                        
                        <style>

                            body{
                                font-family:arial;
                            }

                            h1{
                                text-alighn:center;
                            }

                            h5{
                                color: #284f82;
                            }

                            header,footer{
                                background-color: #284f82;
                            }

                            
                        </style>
                    
                    </body>
                
                </html>
            
            ");
        

            $dompdf->set_option('dafaultFont','sans');

            $dompdf->setPaper('A4','portrait');

            $dompdf->render();

            $dompdf->stream();


            $pdf_data = $dompdf->output();

            $pdf_encoded = chunk_split(base64_encode($pdf_data));

        
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
                $mail->Body = 'Olá, '.$nome.' <br><br>PDF do relatório que foi solicitado na sua conta library, agradecemos a preferencia <br>atenciosamente, equipe Library Manager. <br>';
                // $mail->AltBody = '';
                $mail->addStringAttachment($pdf_data, 'arquivo.pdf', 'base64', 'application/pdf');

                if($mail->send()) {
                    header("Location: msg.php");
                }
                } catch (Exception $e) {
                    //echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
                }
            }
                header("Location: msg.php");

?>

