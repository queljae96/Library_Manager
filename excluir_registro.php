
 <?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $idLivro = $_GET['idLivro'];
    $nome = $_GET['nome'];
    $turma = $_GET['turma'];
    $status = $_GET['status'];
    $statusC = $_GET['statusC'];
    $dado = $_GET['tipoDado'];

        echo "<script>
            var confirmacao = confirm('Tem certeza que excluir esse registro?');                        
        </script>";

        $c = "<script>document.write(confirmacao)</script>";

        if($c == true){
                $atualizarStatus = mysqli_query($conexao,"DELETE FROM emprestar_livro WHERE id = '$idLivro' ");
        }

        echo "<script>
                alert('Registro deletado com sucesso');                        
                window.location = 'visualizar.php?nome=$nome&turma=$turma&statusC=$statusC&id=$id&tipoDado=$dado';
            </script>";
?>
        
