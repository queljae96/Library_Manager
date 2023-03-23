<?php
    session_start();
    include_once('config.php');

    $id = $_GET['id'];
?>

<html>
    <script>
        var id = "<?php echo "$id"; ?>";
        
        var confirmacao = confirm("Tem certeza que deseja excluir este livro?");
 
        if(confirmacao == true){
            window.location = "excluir_livro.php?id="+id;
        }else{
            window.location = "livro.php";
        }                                           
    </script>
</html>