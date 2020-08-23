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
            $visitado = 0;
            $pessoa->marcarVisita($visita->info['id_pessoa'], $visitado);
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

    public function soldalicio($id){
        $soldalicio = new Soldalicio();
        $consagracao =  new Consagracao();
        $pc = new Pessoa_consagracao();
        //Verifica se o id existe;
        if($soldalicio->idExistis($id) == true){
            $soldalicio->getOne($id);
            //Pegando todos os cursos que tem o id do soldalicio;
            $consagracao->getAllSol($id);
            echo '<pre>';
            print_r($consagracao->info);
            //Deletar todos os registros de consagracao para os cursos que foram selecionados;
            for($i=0;$i<count($consagracao->info);$i++){
                $pc->deleteCon($consagracao->info[$i]['id']);
            }
            //Deletar os cursos com o id_soldalicio;
            $consagracao->deleteSol($id);
            //Só agora vamos deletar o soldalício em si;
            $soldalicio->delete($id);
            header("Location: ".BASE_URL."lista/soldalicio");
        }
    }

    public function usuario($id){
        $usuarios = new Usuarios();
        if($usuarios->idExistis($id) == true){
            $usuarios->delete($id);
            header("Location: ".BASE_URL."lista/usuario");
        } else{
            header("Location: ".BASE_URL."lista/usuario");
        }

    }

}