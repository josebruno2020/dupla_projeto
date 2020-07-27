<?php
class Parcela extends Model {
    public $info;
    
    public function getAll(){
        $sql = $this->db->prepare("SELECT * FROM parcela ORDER BY id_visita asc");
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            
        } else{
            return false;
        }
    }

    public function cadastrar($n_parcela, $id_visita, $valor, $vencimento){
        $sql = $this->db->prepare("INSERT INTO parcela SET n_parcela = :n_parcela, id_visita = :id_visita, valor = :valor, vencimento = :vencimento");

        $sql->bindValue(":n_parcela", $n_parcela);
        $sql->bindValue(":id_visita", $id_visita);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":vencimento", $vencimento);
        $sql->execute();
    }

    public function deletarIdVisita($id){
        $sql = $this->db->prepare("DELETE FROM parcela WHERE id_visita = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}