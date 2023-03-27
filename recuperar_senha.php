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
                <p>Digite seu e-mail de acesso para redefinir sua senha. Iremos te mandar um e-mail com instruções de como redefinir sua senha, caso o e-mail não aparecer na tela inicial verifique sua caixa de spam.</p>
                <?php           

                    if(isset($_POST['submit'])){
                        //print_r("maior");
                        include_once('config.php');
                        $email=$_POST['email'];

                        if(!empty($_POST)){
                            //var_dump($email);

                        $verificar_email = mysqli_query($conexao,"SELECT nome,email FROM cadastro_de_usuario WHERE email = '$email'");
                        //print_r($result); 

                        if(mysqli_num_rows($verificar_email)==0){//verificar se o email inserido já está cadastrado
                            echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Usuário inválido! Realize o cadastro para acessar o sistema </font></b></p>";
                        }else{
                            function random_str_mt($size) 
                            {
                                $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

                                $key = '';
                                for ($i = 0; $i < ($size+10); $i++) 
                                {
                                    $key .= $keys[array_rand($keys)];
                                }

                                return substr($key, 0, $size);
                            }

                            $chave = random_str_mt(20);
                            $result_upd_user=mysqli_query($conexao,"UPDATE cadastro_de_usuario SET recuperar_senha = '$chave' WHERE email='$email' LIMIT 1");
                            $select=mysqli_query($conexao,"SELECT recuperar_senha FROM cadastro_de_usuario WHERE email='$email' LIMIT 1");
                            if(mysqli_num_rows($select)!=0){
                                while ($user_data = mysqli_fetch_assoc ($verificar_email)) {
                                    $link = "email.php?chavePD=$chave&nome=$user_data[nome]&email=$_POST[email]";
                                    header("Location: $link");
                                }
                            }
                        
                        }

                    }
                    }

                ?>

                <form action="recuperar_senha.php" method="POST">
                    <input class="dados" type="text" name="email" placeholder="Email">
                    <input class="btn" type="submit" name="submit" value="Enviar">
                </form>
                <a class="recuperar" href="cadastro (1).php"><b>Cadastre-se</b></a>


        </section>

    </main>
</body>
</html>