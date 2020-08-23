<?php
class Finalidade_doacao extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM finalidade_doacao ORDER BY finalidade asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM finalidade_doacao WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetch();
            
        } else{
            return false;
        }
    }
    
}