<?php

    include_once('config.php');

    $tipo = $_GET['tipo'];
    $sttAtual = $_GET['sttAtual'];
    $statusC = $_GET['statusC'];
    $nomeAcesso = $_GET['nome'];
    $idAcesso = $_GET['id'];
    $emailAcesso = $_GET['email'];

    echo "$tipo - $sttAtual - $statusC - $nomeAcesso - $idAcesso - $emailAcesso";

    echo "<script>
            var confirmacao = confirm('Tem certeza que deseja cancelar a solicitação de compartilhamento de dados?');                        
        </script>";

    $c = "<script>document.write(confirmacao)</script>";

    if($c == true){

        if ($tipo == 'p2'){
            if($sttAtual == 'negado'){
                $result = mysqli_query($conexao,"UPDATE permissoes SET deleteUser='permitido' WHERE idAcesso = '$emailAcesso' ");
            }else{
                $result = mysqli_query($conexao,"UPDATE permissoes SET deleteUser='negado' WHERE idAcesso = '$emailAcesso' ");
            }
        }else if($tipo == 'p1'){
            if($sttAtual == 'negado'){
                $result = mysqli_query($conexao,"UPDATE permissoes SET deleteLivro='permitido' WHERE idAcesso = '$emailAcesso' ");
            }else{
                $result = mysqli_query($conexao,"UPDATE permissoes SET deleteLivro='negado' WHERE idAcesso = '$emailAcesso' ");
            }
        }else if($tipo == 'p3'){
            if($sttAtual == 'negado'){
                $result = mysqli_query($conexao,"UPDATE permissoes SET addLivro='permitido' WHERE idAcesso = '$emailAcesso' ");
            }else{
                $result = mysqli_query($conexao,"UPDATE permissoes SET addLivro='negado' WHERE idAcesso = '$emailAcesso' ");
            }
        }else{
            if($sttAtual == 'negado'){
                $result = mysqli_query($conexao,"UPDATE permissoes SET emprestar='permitido' WHERE idAcesso = '$emailAcesso' ");
            }else{
                $result = mysqli_query($conexao,"UPDATE permissoes SET emprestar='negado' WHERE idAcesso = '$emailAcesso' ");
            }
        }

    }

    echo "<script>
            window.location = 'verAcesso.php?id=$idAcesso&statusC=$statusC&nome=$nomeAcesso&email=$emailAcesso';
    </script>";
?>