<?php
class Endereco extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM endereco ORDER BY nome asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }
    public function  getOne($id){
        $sql = $this->db->prepare("SELECT * FROM endereco WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetch();
            return $this->info;
        } else{
            return false;
        }
    }

    public function cadastrar($cep, $rua, $num, $bairro, $cidade, $uf){
        $sql = $this->db->prepare("INSERT INTO endereco SET cep = :cep, rua = :rua, num = :num, bairro = :bairro, cidade = :cidade, uf = :uf");
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":rua", $rua);
        $sql->bindValue(":num", $num);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->execute();

        return $this->info = $this->db->lastInsertId();
    }

    public function mesmoEndereco($cep, $num){
        $sql = $this->db->prepare("SELECT * FROM endereco WHERE cep = :cep AND num = :num");
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":num", $num);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;

        } else{
            return false;
        }
    }

    public function atualizar($id, $cep, $rua, $num, $bairro, $cidade, $uf){
        $sql = $this->db->prepare("UPDATE endereco SET cep = :cep, rua = :rua, num = :num, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id = :id");
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":rua", $rua);
        $sql->bindValue(":num", $num);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deletar($id){
        $sql = $this->db->prepare("DELETE FROM endereco WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}