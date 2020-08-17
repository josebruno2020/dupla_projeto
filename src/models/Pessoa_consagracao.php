<?php
class Pessoa_consagracao extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM pessoa_consagracao ORDER BY id_pessoa asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM pessoa_consagracao WHERE id_pessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetch();
            return $this->info;
        } else{
            return false;
        }
    }

    public function cadastrar($id_pessoa, $id_curso, $renovacao, $concluido){
        $sql = $this->db->prepare("INSERT INTO pessoa_consagracao SET id_pessoa = :id_pessoa, id_curso = :id_curso, renovacao = :renovacao, concluido = :concluido");

        $sql->bindValue(":id_pessoa", $id_pessoa);
        $sql->bindValue(":id_curso", $id_curso);
        $sql->bindValue(":renovacao", $renovacao);
        $sql->bindValue(":concluido", $concluido);
        $sql->execute();
    }

    public function atualizar($id_curso, $renovacao, $concluido, $id_pessoa){
        $sql = $this->db->prepare("UPDATE pessoa_consagracao SET  id_curso = :id_curso, renovacao = :renovacao, concluido = :concluido WHERE id_pessoa = :id_pessoa");
        
        $sql->bindValue(":id_curso", $id_curso);
        $sql->bindValue(":renovacao", $renovacao);
        $sql->bindValue(":concluido", $concluido);
        $sql->bindValue(":id_pessoa", $id_pessoa);
        $sql->execute();
    }

    public function deletar($id){
        $sql = $this->db->prepare("DELETE FROM pessoa_consagracao WHERE id_pessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deleteCon($id_curso){
        $sql = $this->db->prepare("DELETE FROM pessoa_consagracao WHERE id_curso = :id_curso");
        $sql->bindValue(":id_curso", $id_curso);
        $sql->execute();
    }
    
}