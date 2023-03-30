
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">
</head>

<body>
    <header>
        <a href="inicio (1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    <a class="volt" href="inicio (1).php"><img src="img/de-volta (1).png"></a>

    <main>
        
            <section>
                <h2>Cadastre-se</h2>

                <p>Ao clicar em "Enviar" você estará aceitando automaticamente <a href="termos_de_uso.php">as condições e termos de uso</a> do site</p>

                    
                    <?php
                                if(isset($_POST ['submit']))
                                {
                                    //print_r($_POST['nome']);
                                    include_once('config.php');
                                    $nome = $_POST ['nome'];
                                    $email = $_POST ['email'];
                                    $senha = $_POST ['senha'];
                                    $numero_de_compartilhamento = random_int(10000, 999999);

                                    $verificar = mysqli_query($conexao,"SELECT email FROM cadastro_de_usuario WHERE email = '$email'");

                                    //print_r($verificar); 
                                    if((!$nome) || (!$email) || (!$senha)){ //verificar se o input está vazio
                                        echo "<p class='erro'><b><font color=\"#d78700\"> Erro: Preencha todos os campos do formulário </font></b></p>";
                                    }elseif(mysqli_num_rows($verificar)!=0){ //verificar se o email já está cadastrado
                                        echo "<p class='erro'><b><font color=\"#FF0000\"> Erro: Este usuário já está cadastrado. Realize o login para acessar o sistema </font></b></p>";
                                    }else { //adiciona os dados no banco de dados
                                        $date = date("Y-m-d");
                                        $addUser = mysqli_query($conexao,"INSERT INTO cadastro_de_usuario (nome,email,senha,recuperar_senha,compartilhamento_de_dados,id_compartilhamento,data_criacao) VALUES ('$nome','$email','$senha','null','null','$numero_de_compartilhamento','$date')");
                                        $status_user = mysqli_query($conexao,"INSERT INTO status_login (email,statuss) VALUES ('$email','inativo') ");
                                        header('Location: fazer_login.php');
                                        echo "<p class='erro'><b><font color=\"#008000\"> Usuário cadastrado com sucesso! </font></b></p>";
                                    }  
                                }
                    ?>

                    <form action="cadastro.php" method="POST" >
                        <input type="text" name="nome" placeholder="Nome">
                        <input type="text" name="email" placeholder="E-mail">
                        <input type="password" name="senha" placeholder="Criar senha">
                        <input type="submit" name="submit" id="submit" class="btn" ></input>

                    </form>

                    <a class="recuperar" href="fazer_login.php"><b>Fazer login</b></a>
            </section>

    </main>


</body>
</html>