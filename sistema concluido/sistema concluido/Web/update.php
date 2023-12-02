<?php

session_start();

if (empty($_SESSION['usuario'])) {
    echo "<script>alert('Usuário não logado!')</script>";
    echo "<meta http-equiv= 'refresh' content='0; URL=../index.php'/>";
}

$pdo = new PDO("mysql:host=localhost;dbname=dadoslucas","root","");
$sql = $pdo->prepare("SELECT * FROM `info` WHERE id=?");
$sql->execute(array($_POST['id']));
$info = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdo->prepare("UPDATE `info` SET nome=?, endereco=?, numero=?, cidade=?, estado=?, rg=?, cpf=?, sexo=?, `data`=?, email=?, senha=? WHERE id=?");
$sql->execute(array(
    $_POST['nome'], $_POST['end'], $_POST['num'], $_POST['cidade'], $_POST['estado'],
    $_POST['rg'], $_POST['cpf'], $_POST['sexo'], $_POST['datanasc'], $_POST['email'],
    ($_POST['senha']), $_POST['id']));

$_SESSION['erro'] = "<div class='alert alert-success' role='alert'>Alterações realizadas com sucesso!</div>";
echo "<meta http-equiv= 'refresh' content='0; URL=listar.php'/>";

?>