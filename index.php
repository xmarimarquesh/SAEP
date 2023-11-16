<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['nome'];

require_once('classes/Crud.php');
require_once('conexao/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$crud = new Crud($db);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read();
            break;
        case 'read':
            $rows = $crud->read();
            break;

        case 'delete':
            $crud->delete($_GET['id']);
            $rows = $crud->read();
            break;

        default:
            $rows = $crud->read();
            break;
    }
} else {
    $rows = $crud->read();
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <title>Carros</title>
    <style>
        body {
            background-color: r;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: flex;
            margin-top: 10px
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid red;
            border-radius: 4px;
            box-sizing: border-box;

        }

        input[type=text]:focus {
            background-color: #CFCFCF;

        }

        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid red;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        a {
            display: inline-block;
            padding: 4px 8px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #0069d9;
        }

        a.delete {
            background-color: #dc3545;
        }

        a.delete:hover {
            background-color: #c82333;
        }

        #message {
            margin-top: 60px;

        }
    </style>
</head>

<body>
    <div class="container-fluid bg-light border-bottom">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <h4 class="mb-0">Salve,
                <?php echo $email; ?>!
            </h4>
            <h4>Painel do Professor</h4>
            <div>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </div>
    <?php

    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $crud->readOne($id);

        if (!$result) {
            echo "Registro não encontrado.";
            exit();
        }



        $nome = $result['nome'];



        ?>



        <?php

    } else {

        ?>

        <button class="btn btn-primary mr-2" id="toggleFormButtonTurma">Cadastrar Turma</button>


        <form id="carForm" action="?action=create" method="POST" style="display: none;">
            <label for="">Nome</label>
            <input type="text" name="nome" id="nome">
            <input type="submit" value="Cadastrar" name="enviar">
        </form>
        <div id="message" class="alert" role="alert" style="display: none;"></div>

        <?php
    }
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rows->rowCount() == 0) {
                    echo "<tr>";
                    echo "<td colspan='10'>Nenhum dado encontrado</td>";
                    echo "</tr>";
                } else {
                    while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_turma'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>";
                        echo "<a href='view_turma.php?id=" . $row['id_turma'] . "' class='btn btn-warning btn-sm'>Visualizar</a>";
                        echo " ";
                        echo "<a href='?action=delete&id=" . $row['id_turma'] . "' onclick='return confirm(\"Tem certeza que quer apagar esse registro?\")' class='btn btn-danger btn-sm delete'>Deletar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <script>
        document.getElementById('toggleFormButtonTurma').addEventListener('click', function () {
            var formTurma = document.getElementById('carForm');
            formTurma.style.display = (formTurma.style.display === 'none' || formTurma.style.display === '') ? 'block' : 'none';
        });
    </script>

</body>



</html>