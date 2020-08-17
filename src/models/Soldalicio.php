<?php
class Soldalicio extends Model {
    public $info;

    public function idExistis($id){
        $sql = $this->db->prepare("SELECT * FROM soldalicio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0 ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM soldalicio ORDER BY nome asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM soldalicio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0 ){
            return $this->info = $sql->fetch();
        } else {
            return false;
        }
    }

    public function cadastrar($nome){
        $sql = $this->db->prepare("INSERT INTO soldalicio SET nome = :nome");
        $sql->bindValue(":nome", $nome);
        $sql->execute();
    }

    public function delete($id){
        $sql = $this->db->prepare("DELETE FROM soldalicio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}