<div class="row cadastro">
    <h1>Cadastro - Dupla</h1>
    <hr>
    <form action="<?=BASE_URL;?>cadastro/duplaAction" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Sant Elmo:</label>
            <input type="text" name="nome1" id="" class="form-control">
            <label for="">Retaguarda:</label>
            <input type="text" name="nome2" id="" class="form-control">
            
        </div>
        
        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
    </form>
</div>