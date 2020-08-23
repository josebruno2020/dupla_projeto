<div class="row cadastro">
    <h1>Editar Visita - <?=date('d/m/Y', strtotime($visita->info['data']));?></h1>

    <form action="<?=BASE_URL;?>lista/visitaAction/<?=$visita->info['id'];?>" method="post">
        <?php if(!empty($flash)):?>
        <div class="alert alert-info">
            <?=$flash;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            
            <!-- Caso o id seja passado, ele preenche já no campo de Nome visitado; -->
            <label for="">Nome Visitado*:</label>
            <select name="pessoa" id="" class="form-control">
            <option value="<?=$pessoa->info['id'];?>"><?=$pessoa->info['id'].' - '.$pessoa->info['nome'];?></option>
            </select>
            
            <label for="">Data visita*:</label>
            <input type="date" name="data" id="" class="form-control" value="<?=$visita->info['data'];?>">
        </div>
        <div class="form-group">
            <label for="">Dupla*:</label>
            <select name="dupla" id="" class="form-control">
                <option value="<?=$d['id'];?>"><?=$d['nome1'].' - '.$d['nome2'];?></option>
                <?php foreach($dupla->info as $du):?>
                    <option value="<?=$du['id'];?>"><?=$du['nome1']." - ".$du['nome2'];?></option>
                <?php endforeach;?>
            </select>
            <label for="">Sede*:</label>
            <select name="soldalicio" id="" class="form-control">
                <option value="<?=$sol['id'];?>"><?=$sol['nome'];?></option>
                <?php foreach($soldalicio->info as $s):?>
                    <option value="<?=$s['id'];?>"><?=$s['nome'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Resultado*:</label>
            <label for="sim_resultado" class="form-check-label">Doação</label>
            <input type="radio" name="resultado" id="sim_resultado" value="1"
            <?=$visita->info['resultado'] == '1' ? 'checked': '';?>>

            <label for="nao_resultado" class="form-check-label">Recusa</label>
            <input type="radio" name="resultado" id="nao_resultado"  value="0"
            <?=$visita->info['resultado'] == '0' ? 'checked': '';?>>
        </div>
        <div class="form-group group-resultado">
            <label for="">Finalidade:</label>
            <select name="finalidade" id="" class="form-control">
                <option value="<?=$finalidade['id'];?>">
                    <?=$finalidade['finalidade'];?>
                </option>
                <?php foreach($fd->info as $f):?>
                    <option value="<?=$f['id'];?>"><?=$f['finalidade'];?></option>
                <?php endforeach;?>
            </select>
            
            <label for="">Forma Pagamento:</label>
            <select name="pagamento" id="" class="form-control">
                <option value="<?=$forma['id'];?>">
                    <?=$forma['pagamento'];?>
                </option>
                <?php foreach($fp->info as $forma):?>
                    <option value="<?=$forma['id'];?>"><?=$forma['pagamento'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group group-resultado" >
            <label for="">Valor:</label>
            <input type="text" name="valor" id="" class="form-control" value="<?=$visita->info['valor'];?>">

            <label for="">Nº Parcelas:</label>
            <input type="number" name="parcela" id="" class="form-control" value="<?=$visita->info['n_parcela'];?>">
        </div>
        <div class="form-group group-resultado" >
            <label for="">Início das Parcelas:</label>
            <input type="date" name="inicio" id="" class="form-control" value="<?=$visita->info['inicio'];?>">
        </div>

        <div class="form-group">
            <input type="submit" value="Atualizar" class="form-control btn btn-success">
        </div>
    </form>
</div>