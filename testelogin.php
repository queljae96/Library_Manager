<?php
    session_start();
   if(isset($_POST['submit']) && !empty($_POST['email']) && $_POST['senha']){
       //print_r("maior");
       include_once('config.php');
       $email=$_POST['email'];
       $senha=$_POST['senha'];

       $sql  = "SELECT * FROM novouser WHERE email='$email' and senha='$senha'";
       $result = $conexao->query($sql);
       //print_r($result); 

       if(mysqli_num_rows($result)<1){
           unset( $_SESSION['email']);
           unset ($_SESSION['senha']);
           echo("<p>Este e-mail não está cadastrado<p>");
       }else{
           $_SESSION['email'] = $email;
           $_SESSION['senha'] = $senha;
           header("Location: pagprinc(1).php");
       }

   }else{
       print_r("menor");
   }
?>