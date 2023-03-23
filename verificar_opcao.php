
 <?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $turma = $_GET['turma'];
    $status = $_GET['status'];
?>

<html>
    <script>
        var nome = "<?php echo "$nome"; ?>";
        var turma = "<?php echo "$turma"; ?>";
        var status = "<?php echo "$status"; ?>";
        var id = "<?php echo "$id"; ?>";
        
        var confirmacao = confirm("Tem certeza que deseja alterar o status desse usuário?");
 
        if(confirmacao == true){
            window.location = "mudar_status.php?nome="+nome+"&turma="+turma+"&id="+id+"&status="+status;
        }else{
            window.location = "visualizar.php?nome="+nome+"&turma="+turma;
        }
        
                                                  
    </script>
</html>
