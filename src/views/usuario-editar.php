<div class="row cadastro">
    <h1>Usuario - <?=$usuario->info['nome'];?></h1>
    <hr>

    <form action="<?=BASE_URL;?>usuario/editar/<?=$usuario->info['id'];?>" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>

        <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" name="nome" id="" class="form-control" value="<?=$usuario->info['nome'];?>">
        </div>

        <div class="form-group">
            <label for="">E-mail:</label>
            <input type="email" name="email" id="" class="form-control" value="<?=$usuario->info['email'];?>" readonly>
        </div>

        <div class="form-group">
            <label for="">Data Nascimento:</label>
            <input type="date" name="nascimento" id="" class="form-control" value="<?=$usuario->info['nascimento'];?>">
        </div>

        <div class="form-group">
            <input type="submit" value="Atualizar" class="form-control btn btn-success">
        </div>

    </form>
</div>