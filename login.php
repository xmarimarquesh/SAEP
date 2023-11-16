<?php
session_start();
require_once('classes/Usuario.php');
require_once('conexao/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$usuario = new Usuario($db);

if(isset($_POST['logar'])){
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if($usuario->logar($nome,$senha)){
        $_SESSION['nome']=$nome;

        header("Location:index.php");
        exit();
    }else{
        print "<script>alert('Credenciais invalidas')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
</head>
<style>

       

        form{
            max-width: 500px;
            margin: 0 auto;
        }

        label{
            display: flex;
            margin-top: 10px;
        }

        input[type=text]{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=email]{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=password]{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button{
            
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
    
        }

        button:hover{
            background-color: #45a049;
        }
        

        a{
            background-color: #1981CD;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: left;
            
        }

        a:hover{
            background-color: #0069d9;
        }

        h1{
            float:initial
        }
        
       

    </style>
<body>
    
    <form action="" method="POST">
        <div class = "login">
            <h1>Tela de Login</h1>
        </div>
        <label for="Email">Nome</label><input type="text" name="nome" placeholder="Digite Nome..." required>
        <label for="Senha">Senha</label><input type="password" name="senha" placeholder="Digite sua senha..." required>

        <button type="submit" name="logar">Logar</button>
        <a href="cadastrar.php">Criar conta</a>
    </form>
    
</body>
</html>