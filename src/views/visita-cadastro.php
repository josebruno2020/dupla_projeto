<div class="row cadastro">
    <h1>Cadastro - Visita</h1>
    <hr><br>
    <form action="<?=BASE_URL;?>cadastro/visitaAction" method="post">
        <?php if(!empty($flash)):?>
        <div class="alert alert-info">
            <?=$flash;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Nome Visitado*:</label>
            <select name="pessoa" id="" class="form-control">
                <option value=""></option>
                <?php foreach($pessoa->info as $pes):?>
                    <option value="<?=$pes['id'];?>"><?=$pes['id']." - ".$pes['nome'];?></option>
                <?php endforeach;?>
            </select>
            <label for="">Data visita*:</label>
            <input type="date" name="data" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Dupla*:</label>
            <select name="dupla" id="" class="form-control">
                <option value=""></option>
                <?php foreach($dupla->info as $d):?>
                    <option value="<?=$d['id'];?>"><?=$d['nome1']." - ".$d['nome2'];?></option>
                <?php endforeach;?>
            </select>
            <label for="">Sede*:</label>
            <select name="soldalicio" id="" class="form-control">
                <option value=""></option>
                <?php foreach($soldalicio->info as $s):?>
                    <option value="<?=$s['id'];?>"><?=$s['nome'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Resultado*:</label>
            <input type="radio" name="resultado" id="sim_resultado" value="1">Doação
            <input type="radio" name="resultado"  value="0">Recusa
        </div>
        <div class="form-group group-resultado">
            <label for="">Finalidade:</label>
            <select name="finalidade" id="" class="form-control">
                <option value=""></option>
                <?php foreach($fd->info as $f):?>
                    <option value="<?=$f['id'];?>"><?=$f['finalidade'];?></option>
                <?php endforeach;?>
            </select>
            <label for="">Forma Pagamento:</label>
            <select name="pagamento" id="" class="form-control">
                <option value=""></option>
                <?php foreach($fp->info as $forma):?>
                    <option value="<?=$forma['id'];?>"><?=$forma['pagamento'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group group-resultado" >
            <label for="">Valor:</label>
            <input type="text" name="valor" id="" class="form-control">
            <label for="">Nº Parcelas:</label>
            <input type="number" name="parcela" id="" class="form-control">
        </div>
        <div class="form-group group-resultado" >
            <label for="">Início:</label>
            <input type="date" name="inicio" id="" class="form-control">
            <label for="">Término</label>
            <input type="date" name="termino" id="" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
    </form>
</div>