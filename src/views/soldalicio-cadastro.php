<div class="row cadastro">
    <h1>Cadastro - Soldalício</h1>
    <hr>
    <form action="<?=BASE_URL;?>cadastro/soldalicioAction" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Sede:</label>
            <input type="text" name="nome" id="" class="form-control" placeholder="Digite o nome da sede" required>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
    </form>
</div>