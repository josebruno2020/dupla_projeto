<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=BASE_URL;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=BASE_URL;?>assets/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="row"> </div>
    <div class="row fundo-img" style="background-image:url('<?=BASE_URL;?>assets/images/fundo-login.jpg');">
        <div class="row blur">
            <form action="<?=BASE_URL;?>login/loginAction" method="post" class="form">
                <div class="medalhao">
                    <img src="<?=BASE_URL;?>assets/images/medalhao.png" alt="">
                </div>
                <h2>Faça o Seu Login!</h2>
                <br>

                <div class="form-group">
                    <?php if(isset($_SESSION['flash'])):?>
                        <div class="alert alert-<?=$_SESSION['tipo'];?>"><?=$_SESSION['flash'];?></div>
                    <?php endif;?>
                    <?php unset($_SESSION['tipo']);?>
                    <?php unset($_SESSION['flash']);?>
                    <input type="email" name="email" placeholder="E-mail" class="form-control" autofocus="true">
                </div>
                <div class="form-group">
                    <input id="input_senha" type="password" name="senha" placeholder="****" class="form-control">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="" id="mostrar_senha" class="">
                    <label for="mostrar_senha" class="form-check-label">Mostrar Senha</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="Entrar" class="btn btn-primary">
                </div>
                
            </form>
        </div>
    </div>


    <script type="text/javascript" src="<?=BASE_URL;?>assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="<?=BASE_URL;?>assets/js/login.js"></script>
</body>
</html>