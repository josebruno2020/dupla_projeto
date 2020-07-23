<?php 
class HomeController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function index(){
        $this->loadTemplate('home');
    }


    public function sair(){
        unset($_SESSION['lgusuario']);
        header("Location: ".BASE_URL);
    }
}