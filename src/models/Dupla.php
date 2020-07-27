<?php
class Dupla extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM dupla ORDER BY nome1 asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM dupla WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetch();
            return $this->info;
        } else {
            return false;
        }
    }

    public function mesmaDupla($nome1, $nome2){
        $sql = $this->db->prepare("SELECT * FROM dupla WHERE nome1 = :nome1 AND nome2 = :nome2");
        $sql->bindValue(":nome1", $nome1);
        $sql->bindValue(":nome2", $nome2);
        $sql->execute();

        if($sql->rowCount()>0){
            return true;
        } else{
            return false;
        }
    }
    public function cadastrar($nome1, $nome2){
        $sql = $this->db->prepare("INSERT INTO dupla SET nome1 = :nome1, nome2 = :nome2");
        $sql->bindValue(":nome1", $nome1);
        $sql->bindValue(":nome2", $nome2);
        $sql->execute();

    }
    
}