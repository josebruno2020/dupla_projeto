<?php
class Usuarios extends Model {
    public $info;

    public function isLogged() : bool
    {
        if(empty($_SESSION['lgusuario'])) {
            return false;
        } else {
            return true;
        }
    }

    public function fazerLogin($email, $senha): bool
    {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $_SESSION['lgusuario'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = $this->db->prepare("SELECT * FROM usuarios  ORDER BY nome DESC");
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetchAll();
        }
    }

    public function idExistis($id): bool
    {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function emailExistis($email): bool
    {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function getOne($id)
    {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetch();
        } else{
            return false;
        }
    }

    public function cadastrar($nome, $email, $nascimento, $senha, $grupo): void
    {
        $sql = $this->db->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, nascimento = :nascimento, senha = :senha, grupo = :grupo");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":nascimento", $nascimento);
        $sql->bindValue(":senha", md5($senha));
        $sql->bindValue(":grupo", $grupo);
        $sql->execute();
    }

    public function editar($id, $nome, $email, $nascimento): void
    {
        $sql = $this->db->prepare("UPDATE usuarios SET nome = :nome, email = :email, nascimento = :nascimento WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":nascimento", $nascimento);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function updatePassword($pass1, $id): void
    {
        $sql = $this->db->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
        $sql->bindValue(":senha", md5($pass1));
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function delete($id): void
    {
        $sql = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}