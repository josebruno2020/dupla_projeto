<?php
class Consagracao extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM consagracao ORDER BY turma asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function turma_numero($turma){
        $sql = $this->db->prepare("SELECT * FROM consagracao WHERE turma = :turma");
        $sql->bindValue(":turma", $turma);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM consagracao WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $this->info = $sql->fetch();
            return $this->info;
        } else{
            return false;
        }
    }

    public function getAllSol($id_soldalicio){
        $sql = $this->db->prepare("SELECT * FROM consagracao WHERE id_soldalicio = :id_soldalicio");
        $sql->bindValue("id_soldalicio", $id_soldalicio);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            return $this->info = $sql->fetchAll();
        }
    }

    public function cadastrar($turma, $id_soldalicio, $inicio, $fim, $consagracao_data){
        $sql = $this->db->prepare("INSERT INTO consagracao SET turma = :turma, id_soldalicio = :id_soldalicio, inicio = :inicio, fim = :fim, consagracao_data = :consagracao_data");

        $sql->bindValue(":turma", $turma);
        $sql->bindValue(":id_soldalicio", $id_soldalicio);
        $sql->bindValue(":inicio", $inicio);
        $sql->bindValue(":fim", $fim);
        $sql->bindValue(":consagracao_data", $consagracao_data);
        $sql->execute();
    }

    public function deleteSol($id_soldalicio){
        $sql = $this->db->prepare("DELETE FROM consagracao WHERE id_soldalicio = :id_soldalicio");
        $sql->bindValue(":id_soldalicio", $id_soldalicio);
        $sql->execute();
    }
    
}