<?php
class Visita extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM visita ORDER BY data asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }
    public function getByIdPessoa($id){
        $sql = $this->db->prepare("SELECT * FROM visita WHERE id_pessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetch();
            return $this->info;

        } else {
            return false;
        }
    }
    public function getVisita($id){
        $sql = $this->db->prepare("SELECT * FROM visita WHERE id_pessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            return $this->info;

        } else {
            return false;
        }
    }

    public function cadastrar($id_pessoa, $id_dupla, $id_forma_pagamento, $id_finalidade, $id_soldalicio, $resultado, $data, $n_parcela, $valor, $inicio, $termino){

        $sql = $this->db->prepare("INSERT INTO visita SET id_pessoa = :id_pessoa, id_dupla = :id_dupla, id_forma_pagamento = :id_forma_pagamento, id_finalidade = :id_finalidade, id_soldalicio = :id_soldalicio, resultado = :resultado, data = :data, n_parcela = :n_parcela, valor = :valor, inicio = :inicio, termino = :termino");

        $sql->bindValue(":id_pessoa", $id_pessoa);
        $sql->bindValue(":id_dupla", $id_dupla);
        $sql->bindValue(":id_forma_pagamento", $id_forma_pagamento);
        $sql->bindValue(":id_finalidade", $id_finalidade);
        $sql->bindValue(":id_soldalicio", $id_soldalicio);
        $sql->bindValue(":resultado", $resultado);
        $sql->bindValue(":data", $data);
        $sql->bindValue(":n_parcela", $n_parcela);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":inicio", $inicio);
        $sql->bindValue(":termino", $termino);
        $sql->execute();

        return $this->info = $this->db->lastInsertId();
    }

    public function mesmoDia($id_pessoa, $data){
        $sql = $this->db->prepare("SELECT * FROM visita WHERE id_pessoa = :id_pessoa AND data = :data");
        $sql->bindValue(":id_pessoa", $id_pessoa);
        $sql->bindValue(":data", $data);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function deletarIdPessoa($id){
        $sql = $this->db->prepare("DELETE FROM visita WHERE id_pessoa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}