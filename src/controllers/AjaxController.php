<?php 
class AjaxController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function marcar_pagamento($id){
        $pagamento = 1;
        $parcela = new Parcela();
        $parcela->marcarPagamento($pagamento, $id);
    }

    public function desmarcar_pagamento($id){
        $pagamento = 0;
        $parcela = new Parcela();
        $parcela->marcarPagamento($pagamento, $id);
    }

    public function lista_filtrar(){
        if(isset($_POST['lista_nome'])) {
            $filtro = $_POST['lista_nome'];
        } else{
            $filtro = '';
        }
        $pessoa = new Pessoa();
        $pessoa->porFiltro($filtro);
        
        $this->render('nome-filtro', [
            'pessoa' => $pessoa
        ]);
    }
}