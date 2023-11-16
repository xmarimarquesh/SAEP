<?php
require_once('classes/Usuario.php');
require_once('conexao/conexao.php');


session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

require_once('classes/Crud.php');
require_once('conexao/conexao.php');
$database = new Conexao();
$db = $database->getConnection();
$crud = new Crud($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar dados do formulário
    $activityName = $_POST['activityName'];
    $id_turma = $_POST['id_turma'];


    $crud->addActivity($id_turma, $activityName);

    header("Location: view_turma.php?id=" . $id_turma);
    exit();
} else {
    echo "Acesso inválido.";
    exit();
}
?>
