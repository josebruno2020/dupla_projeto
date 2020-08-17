<!DOCTYPE html>
<html>
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto Reconquista</title>
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>assets/css/style.css">
    </header>
    <body>
        <div class="topo" style="background-image:url('<?=BASE_URL;?>assets/images/fundo-menu.jpg');">
            <div class="menu" >
                <ul class="ul-topo">
                    <li>
                        <a href="<?=BASE_URL;?>">Home</a>                        
                    </li>
                    <li>
                        <div id="menu-dropdown">
                            <a href="">Cadastro </a> 
                        </div>
                        <div id="dropdown">
                            <a href="<?=BASE_URL;?>cadastro/nome">Cadastrar Nome</a>
                            <a href="<?=BASE_URL;?>cadastro/visita">Cadastrar Visita</a>
                            <a href="<?=BASE_URL;?>cadastro/curso">Cadastrar Curso</a> 
                            <a href="<?=BASE_URL;?>cadastro/dupla">Cadastrar Dupla</a> 
                            <a href="<?=BASE_URL;?>cadastro/soldalicio">Cadastrar Soldalício</a>                       
                        </div>
                    </li>
                    <li>
                        <div id="menu-dropdown">
                            <a href="">Listar ></a> 
                        </div>
                        <div id="dropdown">
                            <a href="<?=BASE_URL;?>lista/nome">Listar Nomes</a> 
                            <a href="<?=BASE_URL;?>lista/visita">Listar Visitas</a> 
                            <a href="<?=BASE_URL;?>lista/soldalicio">Listar Soldalícios</a> 
                            <a href="<?=BASE_URL;?>lista/dupla">Listar Duplas</a>                      
                        </div>
                    </li>
                    <li>
                        <a href="<?=BASE_URL;?>impressao/">Impressão em PDF</a>
                    </li>
                    <li>
                        <a href="<?=BASE_URL;?>home/sair">Sair</a>
                    </li>
                </ul> 
            </div>
        </div>
        <div class="fundo-img" style="background-image:url('<?=BASE_URL;?>assets/images/fundo.jpg');">
            <div class="container-fluid" s>
                <?=$this->render($viewName, $viewData);?>
            </div>
        </div>
        
        

        <script type="text/javascript" src="<?=BASE_URL;?>assets/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL;?>assets/js/script.js"></script>
    </body>
    <footer>
        <p>Desenvolvido por .... Copyright</p>
    </footer>

</html>