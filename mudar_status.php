
 <?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $idEmprestimo = $_GET['idEmprestimo'];
    $nome = $_GET['nome'];
    $turma = $_GET['turma'];
    $status = $_GET['status'];
    $statusC = $_GET['statusC'];
    $idLivro = $_GET['id_livro'];

    echo "$idLivro - $id ";

        echo "<script>
            var confirmacao = confirm('Tem certeza que deseja cancelar a solicitação de compartilhamento de dados?');                        
        </script>";

        $c = "<script>document.write(confirmacao)</script>";

        if($c == true){
            if($status == "Devolvido" ){
                $atualizarStatus = mysqli_query($conexao,"UPDATE emprestar_livro SET statuss='Pendente' WHERE id = '$idEmprestimo' ");
                $atualizarEstoque = mysqli_query($conexao,"UPDATE livros SET estoque= estoque - 1 WHERE id = '$idLivro' ");

            }else{
                $atualizarStatus2 = mysqli_query($conexao,"UPDATE emprestar_livro SET statuss='Devolvido' WHERE id = '$idEmprestimo' ");
                $atualizarEstoque = mysqli_query($conexao,"UPDATE livros SET estoque = estoque + 1 WHERE id = '$idLivro' ");
            }
        }

        echo "<script>
                window.location = 'visualizar.php?nome=$nome&turma=$turma&statusC=$statusC&id=$id';
            </script>";
?>
        
