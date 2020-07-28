<?php 
class DeletarController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function nome($id){
        $pessoa = new Pessoa();
        $pessoa->getOne($id);
        $pc = new Pessoa_consagracao();
        $visita = new Visita();
        $visita->getByIdPessoa($id);
        $endereco = new Endereco();
        $parcela = new Parcela();

        if($pessoa->idExistis($id) == true){
            //Deletando todos os registros que correspondem com um nome/pessoa;
            $pessoa->deletar($id);
            $endereco->deletar($pessoa->info['id_endereco']);
            $pc->deletar($id);
            $visita->deletarIdPessoa($id);
            $parcela->deletarIdVisita($visita->info['id']);

            header("Location: ".BASE_URL."lista/nome");
            
        } else{
            header("Location: ".BASE_URL."lista/nome");
        }
    }

    public function visita($id){
        $visita = new Visita();
        $visita->getOne($id);
        $pessoa = new Pessoa();
        $pessoa->getOne($visita->info['id_pessoa']);
        $parcela = new Parcela();
        //Verificando o id;
        if($visita->idExistis($id) == true){
            $visita->deletar($id);
            $parcela->deletarIdVisita($id);
            header("Location: ".BASE_URL."lista/nome/".$pessoa->info['id']);
        } else{
            header("Location: ".BASE_URL."lista/nome");
        }
    }

    public function parcela($id){
        $parcela = new Parcela();
        $parcela->getOne($id);
        //Excluindo uma parcela, temos que diminuir um número de parcela na visita correspondente;
        $visita = new Visita();
        $visita->getOne($parcela->info['id_visita']);
        $n_parcela = ($visita->info['n_parcela']) - 1;
        $visita->updateN_parcela($n_parcela, $visita->info['id']);
        $parcela->deletar($id);
        header("Location: ".BASE_URL."lista/parcela/".$visita->info['id']);
    }

}