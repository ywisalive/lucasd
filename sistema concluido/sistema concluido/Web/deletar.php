<?php
    session_start();

    if (empty($_SESSION['usuario'])) {
        echo "<script>alert('Usuário não logado!')</script>";
        echo "<meta http-equiv= 'refresh' content='0; URL=../index.php'/>";
    }

    $pdo = new PDO("mysql:host=localhost;dbname=dadoslucas","root","");
    $sql = $pdo->prepare("DELETE FROM `info` WHERE id=?");
    $sql->execute(array($_GET['id']));

    if ($info[0]['email'] != $_SESSION['usuario']) {
       
        $_SESSION['erro'] = "<div class='alert alert-danger' role='alert'>Usuário inválido para operação!</div>";
        echo "<meta http-equiv= 'refresh' content='0; URL=listar.php'/>";
        exit();

    } 
    
    echo "<scrit>alert('Usuário excluído com sucesso!')</script>";
    $_SESSION['erro'] = "<div class='alert alert-success' role='alert'>Usuário excluído com sucesso!</div>";
    echo "<meta http-equiv= 'refresh' content='0; URL=listar.php'/>";

    


?>