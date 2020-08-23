<?php 
class HomeController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function index(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $pessoa = new Pessoa();
        $pessoa->getAll();
        $visita = new Visita();
        $visita->getAll();
        $parcela = new Parcela();
        $parcela->getAll();
        //Calculo de total de parcelas PAGAS;
        //Total começa valendo 0;
        $total = 0;
        for($i=0;$i<count($parcela->info);$i++){
            if($parcela->info[$i]['pagamento'] == '1'){
                $total = $total + intval($parcela->info[$i]['valor']);
            }
        }
        $this->loadTemplate('home', [
            'pessoa' => $pessoa,
            'visita' => $visita,
            'total' => $total,
            'usuarios' => $usuarios
        ]);
    }


    public function sair(){
        unset($_SESSION['lgusuario']);
        header("Location: ".BASE_URL);
    }
}