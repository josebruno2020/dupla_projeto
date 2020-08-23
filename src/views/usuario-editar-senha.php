<div class="row cadastro">
    <h1>Mudar a Senha - <?=$usuarios->info['nome'];?></h1>
    <hr>

    <form action="<?=BASE_URL;?>usuario/senhaAction/<?=$usuarios->info['id'];?>" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>

        <div class="form-group">
            <input type="password" name="password1" id="input_senha" class="form-control" required placeholder="Digite sua Nova Senha"> 

           
            <input id="input_senha" type="password" name="password2" class="form-control" required placeholder="Confirme sua Nova Senha">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Atualizar" class="form-control btn btn-success">
        </div>
    </form>
</div>