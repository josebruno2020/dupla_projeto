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
    
}