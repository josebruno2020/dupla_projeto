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
        <div class="principal">
            <div class="menu" style="background-image:url('<?=BASE_URL;?>assets/images/fundo-menu.jpg');">
                <ul>
                    <li>
                        <div class="menu-item">
                            <a href="<?=BASE_URL;?>">Home</a>
                        </div>
                    </li>
                    <li>
                        <div id="drop">
                            <div class="drop-item">
                                <a href="">Cadastro ></a> 
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>cadastro/nome">Cadastrar Nome</a>                       
                                </div>
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>cadastro/visita">Cadastrar Visita</a>                       
                                </div>
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>cadastro/curso">Cadastrar Curso</a>                       
                                </div>
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>cadastro/dupla">Cadastrar Dupla</a>                       
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div id="drop">
                            <div class="drop-item">
                                <a href="">Listar ></a> 
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>lista/nome">Listar Nomes</a>                       
                                </div>
                                <div class="dropdown-menu-item">
                                    <a href="<?=BASE_URL;?>lista/visita">Listar Visitas</a>                       
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li>
                        <div class="menu-item">
                            <a href="<?=BASE_URL;?>home/sair">Sair</a>
                        </div>
                    </li>
                </ul>   
                
                
            </div>
            <div class="row" style="background-image:url('<?=BASE_URL;?>assets/images/fundo.jpg');">
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