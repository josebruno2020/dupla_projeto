<?php
class Regiao extends Model {
    public $info;
    
    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM regiao WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetch();
        }
    }

    public function getRegiao($bairro){
        $sql = $this->db->prepare("SELECT * FROM regiao WHERE bairro = :bairro");
        $sql->bindValue(":bairro", $bairro);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetch();
        }
    }
    
}