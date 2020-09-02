<?php
class UsuarioController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function my($id){
        $usuarios = new Usuarios();
        $usuario = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        //Caso seja passado um id nao existente, ele é redirecionado;
        if($usuarios->idExistis($id) == false){
           header("Location: ".BASE_URL);

        } else{
            $usuario->getOne($id);
            $flash = '';
            if(isset($_SESSION['flash'])) {
                $flash = $_SESSION['flash'];
                $_SESSION['flash'] = '';
            }
            
            $this->loadTemplate('usuario-editar', [
                'usuarios' => $usuarios,
                'usuario' => $usuario,
                'flash' => $flash
            ]);
        }
        
    }

    public function editar($id){
        $usuarios = new Usuarios();
        $usuarios->getOne($id);
        //Recebendo os dados para atualização
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $nascimento = filter_input(INPUT_POST, 'nascimento');

        if(($nome != $usuarios->info['nome']) || $email != $usuarios->info['email']){
           
            $usuarios->editar($id, $nome,$email, $nascimento);
            $_SESSION['flash'] = 'Alterações salvas com sucesso!';
            header("Location: ".BASE_URL."usuario/my/".$usuarios->info['id']);

        } else{
            $_SESSION['flash'] = 'Nenhuma alteração realizada!';
            header("Location: ".BASE_URL."usuario/my/".$usuarios->info['id']);
        }
    }


    public function editar_senha($id){
        $usuarios = new Usuarios();
        //Caso seja passado um id nao existente, ele é redirecionado;
        if($usuarios->idExistis($id) == false){
            header("Location: ".BASE_URL);

        } else{
            $usuarios->getOne($id);
            $flash = '';
            if(isset($_SESSION['flash'])) {
                $flash = $_SESSION['flash'];
                $_SESSION['flash'] = '';
            }
            
            $this->loadTemplate('usuario-editar-senha', [
                'usuarios' => $usuarios,
                'flash' => $flash
            ]);
        }
    }

    public function senhaAction($id){
        $usuarios = new Usuarios();
        $usuarios->getOne($id);
        //Recebendo as duas senhas;
        $pass1 = filter_input(INPUT_POST, 'password1');
        $pass2 = filter_input(INPUT_POST, 'password2');

        if($pass1 === $pass2){
            $usuarios->updatePassword($pass1, $id);
            $_SESSION['flash'] = 'Senha alterada com sucesso!';
            header("Location: ".BASE_URL."usuario/editar-senha/".$usuarios->info['id']); 
        } else{
            $_SESSION['flash'] = 'As duas senhas devem ser iguais!';
            header("Location: ".BASE_URL."usuario/editar-senha/".$usuarios->info['id']); 
        }
    }

    
}