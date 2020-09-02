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
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $profissao = new Profissao();
        $profissao->getAll();
        $consagracao = new Consagracao();
        $consagracao->getAll();
        $this->loadTemplate('nome-cadastro', [
            'profissao' => $profissao,
            'consagracao' => $consagracao,
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function nomeAction(){
        //Instanciando os objetos;
        $pessoa = new Pessoa();
        $endereco = new Endereco();
        $regiao = new Regiao();
        $profissao = new Profissao();
        //Calculando o numero de registros na tabela de profissoes para segunrança do select;
        $profissao->getAll();
        $total_profissao = count($profissao->info);
        $pessoa_consagracao = new Pessoa_consagracao();
        //Recebendo os dados do nome;
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $nascimento = filter_input(INPUT_POST, 'nascimento');
        $fone1 = filter_input(INPUT_POST, 'fone1');
        $fone2 = filter_input(INPUT_POST, 'fone2');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        //Recebendo o id da profissão com os filtros de validação de segunraça;
        $id_profissao = filter_input(INPUT_POST, 'profissao', array(
            'options' => array(
                'min_range' => 7,
                'max_range' => $total_profissao,
                'default' => 264 //OUTROS
            )
        ));
        $recpub = filter_input(INPUT_POST, 'recpub');
        $recimgpel = filter_input(INPUT_POST, 'recimgpel');
        $conviteev = filter_input(INPUT_POST, 'conviteev');
        $convitecos = filter_input(INPUT_POST, 'convitecos');
        $con = filter_input(INPUT_POST, 'consagracao');
        //Defenimos como null, porque quando o usuario eh cadastrado, ele ainda nao foi visitado por padrão;
        $visitado = null;

        //Recebendo os dados do endereco (tabelas diferentes);
        $cep = filter_input(INPUT_POST, 'cep');
        $cep = str_replace('-', '', $cep);
        $rua = filter_input(INPUT_POST, 'rua');
        $num = filter_input(INPUT_POST, 'num');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $uf = filter_input(INPUT_POST, 'uf');

        //Dados de consagracao;
        $id_curso = filter_input(INPUT_POST, 'turma', FILTER_VALIDATE_INT);
        $concluido = filter_input(INPUT_POST, 'concluiu');
        $renovacao = filter_input(INPUT_POST, 'renovou');
        //Se os dados principais foram recebidos, primeiro temos que cadastrar o endereço;
        if($nome && $cep && $num){
            //Verificar se há algum registo na tabela de regiao com o bairro informado;
            if($regiao->getRegiao($bairro) == true){
                $id_regiao = $regiao->info['id'];
            } else{
                $id_regiao = null;
            }
            /*
            * ATENÇÃO! Aqui ficava uma verificação para o mesmo endereço, mas tiramos. Caso seja preciso colocar novamente, era aqui que ficava;
            */
            $id_endereco = $endereco->cadastrar($cep, $rua, $num, $bairro, $cidade, $uf, $id_regiao);
            //Quando cadastra o endereco, retorna o id, onde vai ser acrescentado na tabela de pessoa;
            $id_pessoa = $pessoa->cadastrar($nome, $nascimento, $id_endereco, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con, $visitado);
            //Se recevbeu algum dado de consagracao, cadastra;
            if(isset($id_curso)){
                $pessoa_consagracao->cadastrar($id_pessoa, $id_curso, $renovacao, $concluido);
            }

            $_SESSION['flash'] = 'Nome cadastrado com sucesso!';
            header("Location: ".BASE_URL."cadastro/nome");

        } else{
            $_SESSION['flash'] = 'Insira os dados obrigatórios!';
            header("Location: ".BASE_URL."cadastro/nome");

        }

    }

    public function visita($id = ''){
        $pessoa = new Pessoa();
        $pessoa->getAll();
        $dupla = new Dupla();
        $dupla->getAll();
        $fp = new Forma_pagamento();
        $fp->getAll();
        $fd = new Finalidade_doacao();
        $fd->getAll();
        $soldalicio = new Soldalicio();
        $soldalicio->getAll();
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $view = 'visita-cadastro';
        //Caso receba algum id, ai vamos mandar para outro view personalizado;
        if(!empty($id)){
            if($pessoa->idExistis($id) == true){
                $pessoa->getOne($id);
                $view = 'visita-cadastro-id';
            } else{
                header("Location: ".BASE_URL."cadastro/visita");
            }
            
        }

        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->loadTemplate($view, [
            'pessoa' => $pessoa,
            'dupla' => $dupla, 
            'fd' => $fd,
            'fp' => $fp,
            'soldalicio' => $soldalicio,
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function visitaAction(){
        $visita = new Visita();
        $parcela = new Parcela();
        $pessoa = new Pessoa();
        //Recebendo os dados da visita;
        $id_pessoa = filter_input(INPUT_POST, 'pessoa');
        $data = filter_input(INPUT_POST, 'data');
        $id_dupla = filter_input(INPUT_POST, 'dupla');
        $id_soldalicio = filter_input(INPUT_POST, 'soldalicio');
        $resultado = intval(filter_input(INPUT_POST, 'resultado'));
        //Caso resultado seja positivo, recebemos os dados;
        if($resultado == '1'){
            $id_finalidade = filter_input(INPUT_POST, 'finalidade');
            $id_forma_pagamento = filter_input(INPUT_POST, 'pagamento');
            $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
            $valor = str_replace(',', '.', $valor);
            $n_parcela = intval(filter_input(INPUT_POST, 'parcela'));
            $inicio = filter_input(INPUT_POST, 'inicio');
            $termino = filter_input(INPUT_POST, 'termino');
        }

        if($id_pessoa && $data && $id_dupla && $id_soldalicio){
           
            //Verificar se o nome informado já foi visitado nessa data;
            if($visita->mesmoDia($id_pessoa, $data) == false){
                //Cadastra a visita, e retorna o id;
                $id_visita = $visita->cadastrar($id_pessoa, $id_dupla, $id_forma_pagamento, $id_finalidade, $id_soldalicio, $resultado, $data, $n_parcela, $valor, $inicio, $termino);
                //Marcar na tabela de pessoa que ela foi visitada (com o numero 1);
                $visitado = 1;
                $pessoa->marcarVisita($id_pessoa, $visitado);

                if($n_parcela != null || $n_parcela > 0){
                    //Um ciclo 'for' dependendo da quantidade de parcelas, vamos cadastrar na tabela de parcelas;
                    for($i=0;$i<$n_parcela;$i++){
                        $d[$i] = date('Y-m-d', strtotime('+'.$i.' month', strtotime($inicio)));
                        $n[$i] = $i+1;
                        $parcela->cadastrar($n[$i], $id_visita, $valor, $d[$i]);
                    }
                }
                $_SESSION['flash'] = 'Visita Cadastrada com sucesso!';
                header("Location: ".BASE_URL."cadastro/visita");

            } else{

                $_SESSION['flash'] = 'O nome já foi visitado na data informada!';
                header("Location: ".BASE_URL."cadastro/visita");
            }
            

        } else{
            echo $resultado;
            $_SESSION['flash'] = 'Preencha todos os dados obrigatórios!';
            header("Location: ".BASE_URL."cadastro/visita");
        }


    }

    public function curso(){
        $soldalicio = new Soldalicio();
        $soldalicio->getAll();
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);

        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->loadTemplate('curso-cadastro', [
            'soldalicio' => $soldalicio,
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function cursoAction(){
        $consagracao = new Consagracao();
        //Recebendo os dados do curso;
        $turma = filter_input(INPUT_POST, 'turma', FILTER_VALIDATE_INT);
        $id_soldalicio = filter_input(INPUT_POST, 'soldalicio');
        $inicio = filter_input(INPUT_POST, 'inicio');
        $fim = filter_input(INPUT_POST, 'fim');
        $consagracao_data = filter_input(INPUT_POST, 'consagracao_data');

        //Verificando se recebeu os dados obrigatórios;
        if($turma && $id_soldalicio){
            //Verificar se já existe uma turma com esse numero;
            if($consagracao->turma_numero($turma) == false){
                $consagracao->cadastrar($turma, $id_soldalicio, $inicio, $fim, $consagracao_data);
                $_SESSION['flash'] = 'Curso cadastrado com sucesso!';
                header("Location: ".BASE_URL."cadastro/curso");
            } else{

                $_SESSION['flash'] = 'Já existe uma turma com esse número';
                header("Location: ".BASE_URL."cadastro/curso");

            }
        } else{

            $_SESSION['flash'] = 'Insira os dados obrigatórios!';
            header("Location: ".BASE_URL."cadastro/curso");
            
        }
    }

    public function dupla(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->loadTemplate('dupla-cadastro', [
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function duplaAction(){
        $dupla = new Dupla();
        //Recebendo os dados;
        $nome1 = filter_input(INPUT_POST, 'nome1', FILTER_SANITIZE_STRING);
        $nome2 = filter_input(INPUT_POST, 'nome2', FILTER_SANITIZE_STRING);

        if($nome1 && $nome2){
            //Verificar se já existe uma dupla com esses nomes;
            if($dupla->mesmaDupla($nome1, $nome2) == false){
                $dupla->cadastrar($nome1, $nome2);
                $_SESSION['flash'] = 'Dupla cadastrada com sucesso!';
                header("Location: ".BASE_URL."cadastro/dupla");
                
            } else{
                $_SESSION['flash'] = 'Já existe um registro com esses nomes!';
                header("Location: ".BASE_URL."cadastro/dupla");
            }


        } else{
            $_SESSION['flash'] = 'Preencha todos os campos!';
            header("Location: ".BASE_URL."cadastro/dupla");
        }
    }

    public function soldalicio(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->loadTemplate('soldalicio-cadastro', [
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function soldalicioAction(){
        $soldalicio = new Soldalicio();
        //Recebendo os dados;
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        if($nome){ 
            $soldalicio->cadastrar($nome);
            $_SESSION['flash'] = 'Soldalício cadastrado com sucesso!';
            header("Location: ".BASE_URL."cadastro/soldalicio");

        } else{
            $_SESSION['flash'] = 'Preencha todos os campos!';
            header("Location: ".BASE_URL."cadastro/soldalicio");
        }
    }

    public function usuario(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $flash = '';
        if(isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        
        $this->loadTemplate('usuario-novo', [
            'flash' => $flash,
            'usuarios' => $usuarios
        ]);
    }

    public function usuarioAction(){
        $usuarios = new Usuarios();
        //Recebendo os dados;
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $nascimento = filter_input(INPUT_POST, 'nascimento');
        $pass1 = filter_input(INPUT_POST, 'password1');
        $pass2 = filter_input(INPUT_POST, 'password2');
        $grupo = filter_input(INPUT_POST, 'grupo');
        //Verificando se as duas senhas são iguais;
        if($pass1 === $pass2){
            if($usuarios->emailExistis($email) == false){
                $usuarios->cadastrar($nome, $email, $nascimento, $pass1, $grupo);
                $_SESSION['flash'] = 'Usuário cadastrado com sucesso!';
                header("Location: ".BASE_URL."cadastro/usuario"); 
            } else{
                $_SESSION['flash'] = 'E-mail já cadastrado no sistema!';
                header("Location: ".BASE_URL."cadastro/usuario");
            }
            
        } else{
            $_SESSION['flash'] = 'As duas senhas devem ser iguais!';
            header("Location: ".BASE_URL."cadastro/usuario");
        }
    }
}