

<?php


include_once('conexao/conexao.php');

$db = new Conexao();

class Crud
{
    private $conn;
    private $table_name = "carros";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //funcao parar (C)riar meu registros
    public function create($postValues)
    {
        $nome = $postValues['nome'];
        

        $query = "INSERT INTO " . $this->table_name . " (nome) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nome);
        


        $rows = $this->read();
        if ($stmt->execute()) {
            print "<script>alert('Cadastro Ok!')</script>";
            print "<script> location.href='?action=read'; </script>";
            return true;
        } else {
            return false;
        }
    }

    //funcao para Ler os registros
    public function read()
    {
        $searchTerm = "";
        if (isset($_GET['search'])) {
            $searchTerm = trim($_GET['search']);
        }


        if ($searchTerm) {
            $query = "SELECT * FROM ". $this->table_name. " WHERE nome LIKE :searchTerm";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":searchTerm", $searchTerm);
        } else{$query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);}

        $stmt->execute();
        return $stmt;
    }


    //funcao para pegar os registros do banco e inserir no formulario
    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_turma = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //funcao para apagar os registros
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_turma = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addActivity($id_turma, $activityName)
    {
        $stmt = $this->conn->prepare("INSERT INTO atividades (id_turma, nome_atividade) VALUES (:id_turma, :nome_atividade)");
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->bindParam(':nome_atividade', $activityName);
        $stmt->execute();
    }

    public function getAtividadesByTurma($id_turma)
    {
        $stmt = $this->conn->prepare("SELECT * FROM atividades WHERE id_turma = :id_turma");
        $stmt->bindParam(':id_turma', $id_turma);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>