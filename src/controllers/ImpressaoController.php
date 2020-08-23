<?php

use Mpdf\Mpdf;

class ImpressaoController extends Controller {
    
    public function __construct() {
        $usuarios = new Usuarios();
        if($usuarios->isLogged() == false) {
            header("Location: ".BASE_URL."login");
        }
    }

    public function index(){
        $usuarios = new Usuarios();
        $usuarios->getOne($_SESSION['lgusuario']);
        $this->loadTemplate('impressao', [
            'usuarios' => $usuarios
        ]);
    }

    public function impressao(){
        $pessoa = new Pessoa();
        $endereco = new Endereco();
        $visita = new Visita();
        $dupla = new Dupla();
        $profissao = new Profissao();
        $regiao = new Regiao();
        //Recebendo os dados do Checkbox, que estão em formato de array;
        //$busca = $_POST['busca'];
        //Recebendo os dados informados;
        $nome = filter_input(INPUT_POST, 'nome');
        if($nome == '1'){
            $pessoa->getAll();
            $titulo = 'Todos os nomes';
            $view = 'impressao-lista-1';

        }elseif($nome == '2'){
            $visitado = 1;
            $pessoa->getVisitados($visitado);
            $titulo = 'Nomes visitados';
            $view = 'impressao-lista-1';

        } elseif($nome == '3'){
            $visitado = 0;
            $pessoa->getVisitados($visitado);
            $titulo = 'Nomes não visitados';
            $view = 'impressao-lista-2';
        }
        //Salvando toda a página num buffer HTML para que possa ser feita a impressão em seguida;
        ob_start();
        $this->render($view, [
            'pessoa' => $pessoa,
            'endereco' => $endereco,
            'visita' => $visita,
            'titulo' => $titulo,
            'dupla' => $dupla,
            'profissao' => $profissao,
            'regiao' => $regiao
        ]);
        $impressao = ob_get_contents();
        ob_end_clean();
        $impressao;
        //O nome para o arquivo pdf;
        $nome_pdf = md5(time().rand(0,9999).time()).'.pdf';
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);

        $mpdf->WriteHTML($impressao);
        $mpdf->Output($nome_pdf, 'I');      
        
    }
}