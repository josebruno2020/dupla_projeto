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
            <div class="menu">
                <div class="menu-item">
                    <a href="<?=BASE_URL;?>cadastro/nome">Novo Nome</a>
                </div>
            </div>
            <div class="row">
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