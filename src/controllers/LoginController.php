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
        date_default_timezone_set('America/Sao_Paulo');
        $usuarios = new Usuarios();
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');
        
        //Verificando se existe uma sessão com as tentativas;
        if(isset($_SESSION['tentativa']) && $_SESSION['tentativa'] >= 3){
            $hora2 = date('H:i:s', strtotime('+5 minutes'));
            $tempo_transcorrido = (strtotime($hora2) - strtotime($_SESSION['hora']));
            echo $tempo_transcorrido;
            $_SESSION['flash'] = 'Tentou mais de 3 vezes! Bloqueado até: '.$hora2;
            if($tempo_transcorrido >= 600){
                unset($_SESSION['tentativa']);
                $_SESSION['flash'] = 'Tentativas zeradas!';
            }
            
            header("Location: ".BASE_URL);

        } else{

            if($email && $senha){
                //Verifica os dados para fazer o Login;
                if($usuarios->fazerLogin($email, $senha) == true){
                    header("Location: ".BASE_URL);
    
                } else{
                    //Criar uma contagem de vezes que a pessoa pode digitar os campos;
                    if(!isset($_SESSION['tentativa'])){
                        $_SESSION['tentativa'] = 0;
                    }
                    $_SESSION['tentativa']++;
                    $_SESSION['flash'] = 'Usuário e/ou Senha inválidos! Tentativa: '.$_SESSION['tentativa'];
                    //Definindo a hora da tentativa;
                    $_SESSION['hora'] = date('H:i:s');
                    header("Location: ".BASE_URL."login");
                }
    
            } else {
                $_SESSION['flash'] = 'Preencha todos os campos!';
                header("Location: ".BASE_URL."login");
            }
        }
    }
}