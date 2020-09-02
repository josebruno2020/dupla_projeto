<?php
class ListaController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function nome($id = ''){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
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
                $regiao = new Regiao();
                
                //As funções para inserir os dados na tela;
                $pessoa->getOne($id);
                $endereco->getOne($pessoa->info['id_endereco']);
                $regiao->getOne($endereco->info['id_regiao']);
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
                    'dupla' => $dupla,
                    'usuarios' => $usuarios,
                    'regiao' => $regiao
                );

            } else{
                header("Location: ".BASE_URL."lista/nome");
            }
            
        } else{
            $view = 'nome-lista';
            $dados = array(
                'pessoa' => $pessoa,
                'total_paginas' => $total_paginas,
                'p' => $p,
                'usuarios' => $usuarios
            );
        }

        $this->loadTemplate($view, $dados);
    }

    public function nomeAction($id){
        //Instanciando os objetos;
        $pessoa = new Pessoa();
        //pegando os dados da pessoa;
        $pessoa->getOne($id);
        $endereco = new Endereco();
        $regiao = new Regiao();
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
        $visitado = $pessoa->info['visitado'];
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

        //Verificar se há algum registo na tabela de regiao com o bairro informado;
        if($regiao->getRegiao($bairro) == true){
            $id_regiao = $regiao->info['id'];
        } else{
            $id_regiao = null;
        }

        //Não eh necessário verificar se recebeu algum dado, pois ela pode atualizar qualquer dado;
        
        $endereco->atualizar($cep, $rua, $num, $bairro, $cidade, $uf, $id_regiao, $pessoa->info['id_endereco']);

        //Quando cadastra o endereco, retorna o id, onde vai ser acrescentado na tabela de pessoa;
        $pessoa->atualizar($id, $nome, $nascimento, $fone1, $fone2, $email, $id_profissao, $recpub, $recimgpel, $conviteev, $convitecos, $con, $visitado);
        
        //Se recevbeu algum dado de consagracao, cadastra;
        $pessoa_consagracao->atualizar($id_curso, $renovacao, $concluido, $id);
        

        $_SESSION['flash'] = 'Nome atualizado com sucesso!';
        header("Location: ".BASE_URL."lista/nome/".$pessoa->info['id']);
        
    }

    public function visita($id = ''){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
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
        
        //Caso receba algum id como parâmetro;
        if(!empty($id)){
            //Verificar se o id passado existe no banco;
            if($visita->idExistis($id) == true){
                $flash = '';
                if(isset($_SESSION['flash'])) {
                    $flash = $_SESSION['flash'];
                    $_SESSION['flash'] = '';
                }

                $visita->getOne($id);
                $fd = new Finalidade_doacao();
                $fp = new Forma_pagamento();
                $soldalicio = new Soldalicio();
                //$finalidade = $fd->getOne($visita->info['id_finalidade']);
                $pessoa->getOne($visita->info['id_pessoa']);
                $d = $dupla->getOne($visita->info['id_dupla']);
                $dupla->getAll();
                $sol = $soldalicio->getOne($visita->info['id_soldalicio']);
                $soldalicio->getAll();
                $finalidade = $fd->getOne($visita->info['id_finalidade']);
                $forma = $fp->getOne($visita->info['id_forma_pagamento']);
                $fd->getAll();
                $fp->getAll();
                $view = 'visita-editar';
                $dados = array(
                    'usuarios' => $usuarios,
                    'visita' => $visita,
                    'dupla' => $dupla,
                    'pessoa' => $pessoa,
                    'd' => $d,
                    'sol' => $sol,
                    'soldalicio' => $soldalicio,
                    'fd' => $fd,
                    'fp' => $fp,
                    'forma' => $forma,
                    'finalidade' => $finalidade,
                    'flash' => $flash
                );
            } else{
                header("Location: ".BASE_URL."lista/visita");
            }

        } else{
            $view = 'visita-lista';
            $dados = array(
                'visita' => $visita,
                'dupla' => $dupla,
                'pessoa' => $pessoa,
                'p' => $p,
                'total_paginas' => $total_paginas,
                'usuarios' => $usuarios
            );
        }
        $this->loadTemplate($view, $dados);
    }

    public function visitaAction($id){
        $visita = new Visita();
        $parcela = new Parcela();
        $pessoa = new Pessoa();
        $visita->getOne($id);
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
            $valor = filter_input(INPUT_POST, 'valor');
            $valor = str_replace(',', '.', $valor);
            $n_parcela = intval(filter_input(INPUT_POST, 'parcela'));
            $inicio = filter_input(INPUT_POST, 'inicio');
            $termino = filter_input(INPUT_POST, 'termino');
        }
        //Todos os dados já são mandados, então nao precisamos verificar para atualizar;
        if($id_pessoa){
            
            //Caso seja adicionado mais parcelas, temos que inserir no banco;
            if($n_parcela > $visita->info['n_parcela']){
                //Calculando quantas parcelas serão colocadas a mais, para saber quantas vezes o loop será realizado;
                $up = ($n_parcela - intval($visita->info['n_parcela']));                
                for($i=0;$i<$up;$i++){
                    $d[$i] = date('Y-m-d', strtotime('+'.$i.' month', strtotime($inicio)));
                    $n[$i] = intval($visita->info['n_parcela']) +($i + 1);
                    $parcela->cadastrar($n[$i], $id, $valor, $d[$i]);
                }
                //Caso seja tirado alguma parcela, temos que deletar;
            } elseif($n_parcela < $visita->info['n_parcela']){
                $down = intval($visita->info['n_parcela']) - $n_parcela;
                for($i=0;$i < $down;$i++){
                    $n_p[$i] = (intval($visita->info['n_parcela']) - $i);
                    $parcela->deletarNParcela($id, $n_p[$i]);
                }
                
            }

            $visita->update($id_pessoa, $id_dupla, $id_forma_pagamento, $id_finalidade, $id_soldalicio, $resultado, $data, $n_parcela, $valor, $inicio, $termino, $id);
            
            //Temos que atualizar a tabela de parcela igualmente;
            $id_parcela = $parcela->getParcelaVisita($id);

            for($i=0;$i<count($id_parcela);$i++){
                $d[$i] = date('Y-m-d', strtotime('+'.$i.' month', strtotime($inicio)));
                $n[$i] = $i+1;
                $parcela->update($n[$i], $id, $valor, $d[$i], $id_parcela[$i]['id']);
            }
            
        }
        $_SESSION['flash'] = 'Alterações salvas com sucesso!';
        header("Location: ".BASE_URL."lista/visita/".$id);
    }

    //O id que recebe é o da visita, pois toda parcela está relacionada a uma visita em específico;
    public function parcela($id){
        $visita = new Visita();
        //Verificar se o id passado na URL existe; Se nao existe, ja redireciona para a listagem de visitas;
        if($visita->idExistis($id) == false){
            header("Location: ".BASE_URL."lista/visita");
        }
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $pessoa = new Pessoa();
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
            'total_pagar' => $total_pagar,
            'usuarios' => $usuarios
        ]);
    }

    public function soldalicio(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $soldalicio = new Soldalicio();
        $soldalicio->getAll();
        $this->loadTemplate('soldalicio-lista', [
            'soldalicio' => $soldalicio,
            'usuarios' => $usuarios
        ]);
    }

    public function dupla(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $dupla =  new Dupla();
        $dupla->getAll();
        $this->loadTemplate('dupla-lista', [
            'dupla' => $dupla,
            'usuarios' => $usuarios
        ]);

    }

    public function usuario(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $usuario = new Usuarios();
        $usuario->getAll();


        $this->loadTemplate('usuario-listar', [
            'usuarios' => $usuarios,
            'usuario' => $usuario
        ]);
    }

}