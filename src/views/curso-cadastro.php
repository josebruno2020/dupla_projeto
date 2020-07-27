<div class="row cadastro">
    <h1>Cadastro - Curso de Consagração</h1>
    <hr>
    <form action="<?=BASE_URL;?>cadastro/cursoAction" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Nº Turma*:</label>
            <input type="text" name="turma" id="" class="form-control">
            <label for="">Soldalício*:</label>
            <select name="soldalicio" id="" class="form-control">
                <option value=""></option>
                <?php foreach($soldalicio->info as $item):?>
                    <option value="<?=$item['id'];?>"><?=$item['nome'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Data Início:</label>
            <input type="date" name="inicio" id="" class="form-control">
            <label for="">Data fim:</label>
            <input type="date" name="fim" id="" class="form-control">
            <label for="">Data Cons.:</label>
            <input type="date" name="consagracao_data" id="" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
    </form>
</div>