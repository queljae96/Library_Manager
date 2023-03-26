
 <?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $turma = $_GET['turma'];
    $status = $_GET['status'];
    $statusC = $_GET['statusC'];

?>

<html>
    <script>
        var nome = "<?php echo "$nome"; ?>";
        var turma = "<?php echo "$turma"; ?>";
        var statusC = "<?php echo "$statusC"; ?>";
        var status = "<?php echo "$status"; ?>";
        var id = "<?php echo "$id"; ?>";
        
        var confirmacao = confirm("Tem certeza que deseja alterar o status desse usuário?");
 
        if(confirmacao == true){
            window.location = "mudar_status.php?nome="+nome+"&turma="+turma+"&id="+id+"&status="+status+"&statusC="+statusC;
        }else{
            window.location = "visualizar.php?nome="+nome+"&turma="+turma+"&statusC="+statusC;
        }
        
                                                  
    </script>
</html>
