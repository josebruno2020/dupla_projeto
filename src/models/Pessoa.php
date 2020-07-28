<?php
class Pessoa extends Model {
    public $info;

    public function idExistis($id){
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM pessoa ORDER BY nome asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            return $this->info;
        } else{
            return false;
        }
    }

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount()> 0){
            $this->info = $sql->fetch();
        } else{
            return false;
        }
    }


    public function cadastrar($nome, $nascimento, $id_endereco, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con){

        $sql = $this->db->prepare("INSERT INTO pessoa SET nome = :nome, nascimento = :nascimento, id_endereco = :id_endereco, fone1 = :fone1, fone2 = :fone2, email = :email, id_profissao = :id_profissao, recpub = :recpub, recimgpel = :recimgpel, conviteev = :conviteev, convitecos = :convitecos, con = :con");

        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":nascimento", $nascimento);
        $sql->bindValue(":id_endereco", $id_endereco);
        $sql->bindValue(":fone1", $fone1);
        $sql->bindValue(":fone2", $fone2);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id_profissao", $id_profissao);
        $sql->bindValue(":recpub", $recpub);
        $sql->bindValue(":recimgpel", $recimgpel);
        $sql->bindValue(":conviteev", $conviteev);
        $sql->bindValue(":convitecos", $convitecos);
        $sql->bindValue(":con", $con);
        $sql->execute();

        return $this->info = $this->db->lastInsertId();
    }

    public function atualizar($id, $nome, $nascimento, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con){

        $sql = $this->db->prepare("UPDATE pessoa SET nome = :nome, nascimento = :nascimento, fone1 = :fone1, fone2 = :fone2, email = :email, id_profissao = :id_profissao, recpub = :recpub, recimgpel = :recimgpel, conviteev = :conviteev, convitecos = :convitecos, con = :con WHERE id = :id");

        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":nascimento", $nascimento);
        $sql->bindValue(":fone1", $fone1);
        $sql->bindValue(":fone2", $fone2);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id_profissao", $id_profissao);
        $sql->bindValue(":recpub", $recpub);
        $sql->bindValue(":recimgpel", $recimgpel);
        $sql->bindValue(":conviteev", $conviteev);
        $sql->bindValue(":convitecos", $convitecos);
        $sql->bindValue(":con", $con);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deletar($id){
        $sql = $this->db->prepare("DELETE FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}