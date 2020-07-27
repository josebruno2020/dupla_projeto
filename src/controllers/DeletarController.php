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

}