<?php 
class ListaController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function nome($id = ''){
        $pessoa = new Pessoa();
        $pessoa->getAll();
        $total_nome = count($pessoa->info);
        $p = 1;
        if(isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }
        $por_pagina = 25;
        $total_paginas = ceil($total_nome / $por_pagina);
        $pessoa->getTotalPagina($p, $por_pagina);
        
        if(!empty($id)){
            if($pessoa->idExistis($id) == true){
                $flash = '';
                if(isset($_SESSION['flash'])) {
                    $flash = $_SESSION['flash'];
                    $_SESSION['flash'] = '';
                }

                $endereco = new Endereco();
                $profissao = new Profissao();
                $pro = new Profissao();
                $consagracao = new Consagracao();
                $consa = new Consagracao();
                $consagracao->getAll();
                $pc = new Pessoa_consagracao();
                $visita = new Visita();
                $dupla = new Dupla();

                //As funções para inserir os dados na tela;
                $pessoa->getOne($id);
                $endereco->getOne($pessoa->info['id_endereco']);
                $pro->getOne($pessoa->info['id_profissao']);
                $profissao->getAll();
                if($pc->getOne($id) == true){
                    $consa->getOne($pc->info['id_curso']);
                }
                
                $visita->getVisita($id);
                //Calculando a idade da pessoa
                if($pessoa->info['nascimento'] != '0000-00-00'){
                    $idade = intval(date('Y', time())) - intval(substr( $pessoa->info['nascimento'], 0, 4));
                } else{
                    $idade = 0;
                }
                
                $view = 'nome-editar';
                $dados = array(
                    'pessoa' => $pessoa,
                    'idade' => $idade,
                    'endereco' => $endereco, 
                    'profissao' => $profissao, 
                    'pro' => $pro,
                    'consagracao' => $consagracao,
                    'pc' => $pc,
                    'consa' => $consa,
                    'flash' => $flash,
                    'visita' => $visita,
                    'dupla' => $dupla
                );

            } else{
                header("Location: ".BASE_URL."lista/nome");
            }
            
        } else{
            $view = 'nome-lista';
            $dados = array(
                'pessoa' => $pessoa,
                'total_paginas' => $total_paginas,
                'p' => $p
            );
        }

        $this->loadTemplate($view, $dados);
    }

    public function nomeAction($id){
        //Instanciando os objetos;
        $pessoa = new Pessoa();
        $endereco = new Endereco();
        $pessoa_consagracao = new Pessoa_consagracao();
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
        $con = filter_input(INPUT_POST, 'consagracao');

        //Recebendo os dados do endereco (tabelas diferentes);
        $cep = filter_input(INPUT_POST, 'cep');
        $cep = str_replace('-', '', $cep);
        $rua = filter_input(INPUT_POST, 'rua');
        $num = filter_input(INPUT_POST, 'num');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $uf = filter_input(INPUT_POST, 'uf');

        //Dados de consagracao;
        $id_curso = filter_input(INPUT_POST, 'turma');
        $concluido = filter_input(INPUT_POST, 'concluiu');
        $renovacao = filter_input(INPUT_POST, 'renovou');

        //Não eh necessário verificar se recebeu algum dado, pois ela pode atualizar qualquer dado;
        //pegando os dados da pessoa;
        $pessoa->getOne($id);

        $endereco->atualizar($pessoa->info['id_endereco'], $cep, $rua, $num, $bairro, $cidade, $uf);

        //Quando cadastra o endereco, retorna o id, onde vai ser acrescentado na tabela de pessoa;
        $pessoa->atualizar($id, $nome, $nascimento, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con);
        
        //Se recevbeu algum dado de consagracao, cadastra;
        
        $pessoa_consagracao->atualizar($id_curso, $renovacao, $concluido, $id);
        

        $_SESSION['flash'] = 'Nome atualizado com sucesso!';
        header("Location: ".BASE_URL."lista/nome/".$pessoa->info['id']);
        
    }

    public function visita(){
        $visita = new Visita();
        $dupla = new Dupla();
        $pessoa = new Pessoa();
        $visita->getAll();
        $total_visita = count($visita->info);
        $p = 1;
        if(isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }
        $por_pagina = 25;
        $total_paginas = ceil($total_visita / $por_pagina);
        $visita->getTotalPagina($p, $por_pagina);
        

        $this->loadTemplate('visita-lista', [
            'visita' => $visita,
            'dupla' => $dupla,
            'pessoa' => $pessoa,
            'p' => $p,
            'total_paginas' => $total_paginas,
            
        ]);
    }

    //O id que recebe é o da visita, pois toda parcela está relacionada a uma visita em específico;
    public function parcela($id){
        $pessoa = new Pessoa();
        $visita = new Visita();
        $pg = new Forma_pagamento();
        $visita->getOne($id);
        $pessoa->getOne($visita->info['id_pessoa']);
        $pg->getOne($visita->info['id_forma_pagamento']);
        $parcela = new Parcela();
        $parcela->getParcelaVisita($id);
        $total_pagar = 0;
        $total_pago = 0;
        //Definir quanto a pessoa já pagou somando os valores onde a coluna 'pagamento' for '1';
        for($i=0;$i<count($parcela->info);$i++){
            if($parcela->info[$i]['pagamento'] == '1'){
                $total_pago = $total_pago + intval($parcela->info[$i]['valor']);
            } else{
                $total_pagar = $total_pagar + intval($parcela->info[$i]['valor']);
            }
        }

        $this->loadTemplate('parcela-lista', [
            'visita' => $visita,
            'parcela' => $parcela,
            'pessoa' => $pessoa,
            'pg' => $pg,
            'total_pago' => $total_pago,
            'total_pagar' => $total_pagar
        ]);
    }

    public function soldalicio(){
        $soldalicio = new Soldalicio();
        $soldalicio->getAll();
        $this->loadTemplate('soldalicio-lista', ['soldalicio' => $soldalicio]);
    }

    public function dupla(){
        $dupla =  new Dupla();
        $dupla->getAll();
        $this->loadTemplate('dupla-lista', ['dupla' => $dupla]);

    }

}