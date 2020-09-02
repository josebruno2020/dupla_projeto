<?php
class Pessoa extends Model {
    public $info;

    public function idExistis($id)
    {
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }
    
    public function getAll()
    {
        $sql = $this->db->prepare("SELECT * FROM pessoa");
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetchAll();
        } else{
            return false;
        }
    }

    public function getOne($id)
    {
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount()> 0){
            $this->info = $sql->fetch();
        } else{
            return false;
        }
    }

    public function porFiltro($filtro)
    {
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE nome like :filter ORDER BY id ASC");
        $sql->bindValue(":filter", "%".$filtro."%");
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $this->info = $sql->fetchAll();
        } else{
            return false;
        }
    }

    public function getBusca($busca)
    {
        $sql = $this->db->prepare("SELECT :busca FROM pessoa");
        $sql->bindValue(":busca", implode(',', $busca));
        $sql->execute();
        if($sql->rowCount() > 0){
            return $this->info = $sql->fetchAll();
        } 
    }

    public function getVisitados($visitado
    ){
        $sql = $this->db->prepare("SELECT * FROM pessoa WHERE visitado = :visitado");
        $sql->bindValue(":visitado", $visitado);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $this->info = $sql->fetchALl();
        }
    }

    public function getTotalPagina($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;

        $sql = $this->db->prepare("SELECT * FROM pessoa ORDER BY nome ASC LIMIT $offset, $perPage");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $this->info = $sql->fetchAll();

        }

        return $this->info;
    }

    public function cadastrar($nome, $nascimento, $id_endereco, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con, $visitado) :int
    {

        $sql = $this->db->prepare("INSERT INTO pessoa SET 
        nome = :nome, 
        nascimento = :nascimento, 
        id_endereco = :id_endereco, 
        fone1 = :fone1, 
        fone2 = :fone2, 
        email = :email, 
        id_profissao = :id_profissao, 
        recpub = :recpub, 
        recimgpel = :recimgpel, 
        conviteev = :conviteev, 
        convitecos = :convitecos, 
        con = :con,
        visitado = :visitado");

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
        $sql->bindValue(":visitado", $visitado);
        $sql->execute();

        return $this->info = $this->db->lastInsertId();
    }

    public function atualizar($id, $nome, $nascimento, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con) :void
    {

        $sql = $this->db->prepare("UPDATE pessoa SET 
        nome = :nome, 
        nascimento = :nascimento, 
        fone1 = :fone1, 
        fone2 = :fone2, 
        email = :email, 
        id_profissao = :id_profissao, 
        recpub = :recpub, 
        recimgpel = :recimgpel, 
        conviteev = :conviteev, 
        convitecos = :convitecos, 
        con = :con WHERE id = :id");

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

    public function marcarVisita($id, $visitado) :void
    {
        $sql = $this->db->prepare("UPDATE pessoa SET visitado = :visitado WHERE id = :id");
        $sql->bindValue(":visitado", $visitado);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deletar($id) : void
    {
        $sql = $this->db->prepare("DELETE FROM pessoa WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}