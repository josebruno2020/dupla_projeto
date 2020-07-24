<?php 
class CadastroController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function nome(){
        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $profissao = new Profissao();
        $profissao->getAll();
        $this->loadTemplate('nome-cadastro', [
            'profissao' => $profissao,
            'flash' => $flash
        ]);
    }

    public function nomeAction(){
        //Instanciando os objetos;
        $pessoa = new Pessoa();
        $endereco = new Endereco();
        //Recebendo os dados do nome;
        $nome = filter_input(INPUT_POST, 'nome');
        $nascimento = filter_input(INPUT_POST, 'nascimento');
        $fone1 = filter_input(INPUT_POST, 'fone1');
        $fone2 = filter_input(INPUT_POST, 'fone2');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $id_profissao = filter_input(INPUT_POST, 'profissao');
        $recpub = filter_input(INPUT_POST, 'recpub');
        $recimgpel = filter_input(INPUT_POST, 'recimgpel');
        $conviteev = filter_input(INPUT_POST, 'conviteev');
        $convitecos = filter_input(INPUT_POST, 'convitecos');

        //Recebendo os dados do endereco (tabelas diferentes);
        $cep = filter_input(INPUT_POST, 'cep');
        $rua = filter_input(INPUT_POST, 'rua');
        $num = filter_input(INPUT_POST, 'num');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $uf = filter_input(INPUT_POST, 'uf');

        //Se os dados principais foram recebidos, primeiro temos que cadastrar o endereço;
        if($nome && $cep && $cidade){
            if($endereco->mesmoEndereco($cep, $num)==false){
                $id_endereco = $endereco->cadastrar($cep, $rua, $num, $bairro, $cidade, $uf);

                //Quando cadastra o endereco, retorna o id, onde vai ser acrescentado na tabela de pessoa;
                $pessoa->cadastrar($nome, $nascimento, $id_endereco, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos);
            

                $_SESSION['flash'] = 'Nome cadastrado com sucesso!';
                header("Location: ".BASE_URL."cadastro/nome");
            } else{
                $_SESSION['flash'] = 'Já existe um nome para nesse endereço! Nome não cadastrado!';
                header("Location: ".BASE_URL."cadastro/nome");
            }
            

        } else{
            $_SESSION['flash'] = 'Insira os dados obrigatórios!';
            header("Location: ".BASE_URL."cadastro/nome");

        }

    }


    
}