<?php 
class LoginController extends Controller {

    public function index() {
        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('login', [
            'flash' => $flash
        ]);
        
    }

    public function loginAction(){
        $usuarios = new Usuarios();
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');

        if($email && $senha){
            if($usuarios->fazerLogin($email, $senha) == true){

                header("Location: ".BASE_URL);

            } else{

                $_SESSION['flash'] = 'Usuário e/ou Senha inválidos!';
                header("Location: ".BASE_URL."login");
            }

        } else {
            $_SESSION['flash'] = 'Preencha todos os campos!';
            header("Location: ".BASE_URL."login");
        }
    }

}