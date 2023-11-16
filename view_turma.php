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

if (isset($_GET['id'])) {
    $id_turma = $_GET['id'];
    $detalhes_turma = $crud->readOne($id_turma);

    if (!$detalhes_turma) {
        echo "Turma não encontrada.";
        exit();
    }

    $nome_turma = $detalhes_turma['nome'];

    $atividades = $crud->getAtividadesByTurma($id_turma);

} else {
    echo "ID da turma não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Visualizar Turma</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        
        body{
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


<body>

    <div class="container-fluid bg-light border-bottom">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <h4 class="mb-0">Salve,
                <?php echo $email; ?>!
            </h4>
            <h4>
                <p>
                    <?php echo $nome_turma; ?>
                </p>
            </h4>
            <div>
                <a href="index.php" class="btn btn-danger">Turmas</a>
            </div>
        </div>
    </div>

    <button class="btn btn-primary mt-3" id="toggleFormButton">Cadastrar Atividade</button>

    <form id="addActivityForm" action="add_activity.php" method="POST" style="display: none;">
        <label for="activityName">Nome da Atividade:</label>
        <input type="text" name="activityName" id="activityName" required>
        <input type="hidden" name="id_turma" value="<?php echo $id_turma; ?>">
        <input type="submit" value="Adicionar Atividade">
    </form>



    <h3>Atividades</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Número</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($atividades as $atividade) {
                echo "<tr>";
                echo "<td>" . $atividade['id_atividade'] . "</td>";
                echo "<td>" . $atividade['nome_atividade'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>


    <script>
        document.getElementById('toggleFormButton').addEventListener('click', function() {
            var form = document.getElementById('addActivityForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        });
    </script>

</body>

</html>