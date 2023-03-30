<?php
    session_start();
    include_once('config.php');

    $logado = $_SESSION['email'];
    $statusC = $_GET['statusC'];

    if(isset($_POST['submit'])){

        $livroDataMin = $_POST['livroDataMin'];
        $livroDataMax = $_POST['livroDataMax'];
        $usuarioDataMin = $_POST['userDataMin'];
        $usuarioDataMax = $_POST['userDataMax'];

        header ("Location: solicitar_relatorio.php?livroDataMin=$livroDataMin&livroDataMax=$livroDataMax&usuarioDataMin=$usuarioDataMin&usuarioDataMax=$usuarioDataMax");
    }

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <link rel="icon" type="image/png" href="img/Library (1).png">

    <title>Solicitar relatório</title>
</head>

<body>
    <header>
        <a href="pagprinc(1).php"><img class="logo" src="img/2 (1).png" alt=""></a>
    </header>

    
    <a class="volt" href="pagprinc(1).php"><img src="img/de-volta (1).png"></a>

    <main>
   
    <section>
        <h1>Solicitar relatório</h1>

            <form action="" method="POST">

                <?php  $date = date('Y-m-d'); ?>

                <label class="desc"><b>Usuários cadastrados:</b> </label>
                <input class="selDat" type="date" name="userDataMin" required max="<?php echo "$date";?>">
                <input class="selDat" type="date" name="userDataMax" required max="<?php echo "$date";?>">

                <label class="desc"><b>Livros emprestados:</b> </label>
                <input class="selDat" type="date" name="livroDataMin" required max="<?php echo "$date";?>">
                <input class="selDat" type="date" name="livroDataMax" required max="<?php echo "$date";?>">
                <input class="btn" type="submit" name="submit" value="Enviar">
            </form>
    
    </section>

    </main>
</body>
</html>