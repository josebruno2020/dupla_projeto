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

    public function getOne($id){
        $sql = $this->db->prepare("SELECT * FROM parcela WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount()> 0){
            $this->info = $sql->fetch();
        } else{
            return false;
        }
    }

    public function getParcelaVisita($id_visita){
        $sql = $this->db->prepare("SELECT * FROM parcela WHERE id_visita = :id_visita");
        $sql->bindValue(":id_visita", $id_visita);
        $sql->execute();

        if($sql->rowCount() > 0){
            $this->info = $sql->fetchAll();
            return $this->info;
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

    public function update($n_parcela, $id_visita, $valor, $vencimento, $id){
        $sql = $this->db->prepare("UPDATE parcela SET n_parcela = :n_parcela, id_visita = :id_visita, valor = :valor, vencimento = :vencimento
        WHERE id = :id");

        $sql->bindValue(":n_parcela", $n_parcela);
        $sql->bindValue(":id_visita", $id_visita);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":vencimento", $vencimento);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function marcarPagamento($pagamento, $id){
        $sql = $this->db->prepare("UPDATE parcela SET pagamento = :pagamento WHERE id = :id");
        $sql->bindValue(":pagamento", $pagamento);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    //Função que vai deletar a parcela quando for indicado uma valor menor que o numero atual de parcelas na visita; Sempre delatando o numero de maior valor para a vista indicada. Nescessário o id da visita e o numero da parcela que será deletado;
    public function deletarNParcela($id_visita, $n_parcela){
        $sql = $this->db->prepare("DELETE FROM parcela WHERE id_visita = :id_visita AND n_parcela = :n_parcela");
        $sql->bindValue(":id_visita", $id_visita);
        $sql->bindValue(":n_parcela", $n_parcela);
        $sql->execute();
    }

    //Função para deletar todas as parcelas de uma visita;
    public function deletarIdVisita($id){
        $sql = $this->db->prepare("DELETE FROM parcela WHERE id_visita = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    //Função para deletar um registro de parcela;
    public function deletar($id){
        $sql = $this->db->prepare("DELETE FROM parcela WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}