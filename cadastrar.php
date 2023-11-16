<?php

    require_once('classes/Usuario.php');
    require_once('conexao/conexao.php');

    $database = new Conexao();
    $db = $database->getConnection();
    $usuario = new Usuario($db);

    if(isset($_POST['cadastrar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confSenha = $_POST['confSenha'];

        if($usuario->cadastrar($nome,$email,$senha,$confSenha)){
            echo "<form>Cadastro realizado com sucesso</form>";
        }else{
            echo "<form>Erro ao cadastrar</form>";
        }
    }

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
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
    
    <form method = "POST">
        <div class = "cadas">
            <h1>Tela de Cadastro</h1>
        </div>
        <label for="Email">Nome</label>
        <input type="text" name = "nome" placeholder = "Coloque seu nome" REQUIRED>
        <label for="Email">E-mail</label>
        <input type="email" name = "email" placeholder = "Coloque seu email" REQUIRED>
        <label for="Senha">Senha</label>
        <input type="password" name = "senha" placeholder = "Coloque sua senha" maxlength = "8" REQUIRED>
        <label for="Senha">Confirme sua senha</label>
        <input type="password" name = "confSenha" placeholder = "Coloque sua senha" maxlength = "8" REQUIRED>

        <button type="submit" name="cadastrar">Cadastrar</button>
        <a href="login.php">Clique aqui para logar</a>
    </form>
        
    
</body>
</html>