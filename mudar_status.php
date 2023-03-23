
 <?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $turma = $_GET['turma'];
    $status = $_GET['status'];

if($status == "Devolvido" ){
        $atualizarStatus2 = mysqli_query($conexao,"UPDATE emprestar_livro SET statuss='Pendente' WHERE id='$id' ");
    }else{
        $atualizarStatus = mysqli_query($conexao,"UPDATE emprestar_livro SET statuss='Devolvido' WHERE  id='$id' ");
    }
    header("Location: visualizar.php?nome=$nome&turma=$turma");
?>