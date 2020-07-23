<!DOCTYPE html>
<html>
    <header>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto Reconquista</title>
        <link rel="stylesheet" href="<?=BASE_URL;?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>/public/assets/css/style.css">
    </header>
    <body>
        <h1>Esté é o meu site</h1>
        <hr>
        <?=$this->render($viewName, $viewData);?>





        <script type="text/javascript" src="<?=BASE_URL;?>/public/assets/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL;?>/public/assets/js/script.js"></script>
    </body>
    <footer>
        <p>Desenvolvido por .... Copyright</p>
    </footer>

</html>