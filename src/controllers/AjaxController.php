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
}