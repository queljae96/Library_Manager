<?php
    session_start();
    ob_start();
    include_once('config.php')

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library.png">

    <title>Recuperar senha</title>
</head>

<body>
    <header>
        <a href="fazer_login.php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>
    
    <a class="volt" href="cadastro.php"><img src="img/de-volta (1).png"></a>

    <main>

        <section>

                <h1>Recuperar senha</h1>
                <p>Enviamos um e-mail com instruções para a redefinição da sua senha. Caso o e-mail não apareça na tela principal verifique sua caixa de span.<br><br> Atenciosamente, equipe Library Manager</p>
                

        </section>

    </main>
</body>
</html>