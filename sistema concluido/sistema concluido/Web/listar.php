<?php

session_start();

if (empty($_SESSION['usuario'])) {
    echo "<script>alert('Usuário não logado!')</script>";
    echo "<meta http-equiv= 'refresh' content='0; URL=../index.php'/>";
}

$pdo = new PDO("mysql:host=localhost;dbname=dadoslucas","root","");
$sql = $pdo->prepare("SELECT id, nome, email FROM `info`");
$sql->execute(array());
$info = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class=bg-secondary>
    
    <nav class="navbar bg-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="..\Recursos/logo.gif" alt="" width="150px"></a>
            <a class="btn btn-success" href="principal.php">Sair</a>
        </div>
    </nav>

    <div class="container text-center mt-4">
        <h2>Lista de Usuários cadastrados</h2>

        <?php
          
            if (!empty($_SESSION['erro'])) {
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
        ?>
        
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
      
            <?php
             
                $pdo = new PDO('mysql:host=localhost;dbname=dadoslucas','root','');
                $sql = $pdo->prepare("SELECT id, nome, email FROM `info`");
                $sql->execute(array());
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);

               

                foreach ($info as $key => $value) {

                    echo "<form action='editar.php' method='get'>";
                    echo "<tr>";
                        echo "<th scope='row'>".$info[$key]['id']."</th>";
                        echo "<td>".$info[$key]['nome']."</td>";
                        echo "<td>".$info[$key]['email']."</td>";
                        echo "<td>";
                            echo "<a class='btn btn-success' href='editar.php?id=".$info[$key]['id']."'>Editar</a>";
                            echo "<a class='btn btn-info' href='deletar.php?id=".$info[$key]['id']."'>excluir</a>";    
                        echo "</td>";
                    echo "</tr>";
                    echo "</form>";

                }
            ?>
        
        </tbody>
        </table>
    </div>

   
    <footer class="footer text-center fixed-bottom bg-dark py-3">
        <div class="container">
            <p class="text-light">Todas as suas informações estão seguras em nossa site</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>