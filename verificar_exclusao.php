<?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
    $statusC = $_GET['statusC'];
    $dado = $_GET['tipoDado'];
?>

<html>
    <script>
        var id = "<?php echo "$id"; ?>";
        var statusC = "<?php echo "$statusC"; ?>";
        var dado = "<?php echo "$dado"; ?>";

        var confirmacao = confirm("Tem certeza que deseja excluir este livro?");
 
        if(confirmacao == true){
            window.location = "excluir_livro.php?id="+id+"&statusC="+statusC+"&tipoDado="+dado;
        }else{
            window.location = "livro.php";
        }                                           
    </script>
</html>