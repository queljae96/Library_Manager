
<?php

	$chave=$_GET["chavePD"];
	$nome=$_GET["nome"];
	$email = $_GET["email"];

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
		$mail->Password = 'uvqaucmvrkcbxdct';
		$mail->Port = 587;
	
		$mail->setFrom('suportelibrarymanager@gmail.com');
		$mail->addAddress($email);
		// $mail->addAddress('quel03102004@gmail.com');
	
		$mail->isHTML(true);
		$mail->Subject = 'Atualizar senha - Library Manager';
		$mail->Body = 'Link para atualizar a senha de acesso <br><br> Olá, '.$nome.' <a href=http://localhost:8888/bibliotech(1)/atualizar_senha.php?chavePD='.$chave.'&nome='.$nome.'&email='.$email.'> Clique aqui </a>  para redefinir sua senha de acesso.<br><br> Se você não deseja alterar sua senha ou não solicitou uma redefinição, ignore e exclua este e-mail.<br><br>atenciosamente, equipe Library Manager.
		';
		// $mail->AltBody = '';
	
		if($mail->send()) {
			header("Location: msg.php");
			// die();
			print_r("email enviado com sucesso");
		}
	} catch (Exception $e) {
		echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}