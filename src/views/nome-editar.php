<div class="row lista">
    <h1>Cadastro - Novo Nome</h1>
    <hr><br>
    <form action="<?=BASE_URL;?>lista/nomeAction/<?=$pessoa->info['id'];?>" method="POST" class="form">
        <?php if(!empty($flash)):?>
        <div class="alert alert-info">
            <?=$flash;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Nome*:</label> 
            <input type="text" name="nome" id="" class="form-control" placeholder="Nome" value="<?=$pessoa->info['nome'];?>">
            <label for="">Nascimento:</label> 
            <input type="date" name="nascimento" id="" class="form-control" value="<?=$pessoa->info['nascimento'];?>">   
            <label for="">Idade:</label> 
            <input type="text" name="idade" id="" class="form-control" readonly value="<?=$idade;?>">
        </div>
        <div class="form-group">
            <label for="">CEP*:  </label>
            <input type="text" name="cep" id="cep" class="form-control" placeholder="00000-000" value="<?=$endereco->info['cep'];?>   ">
            <label for="">Rua:</label> 
            <input type="text" name="rua" id="rua" class="form-control" placeholder="Rua" value="<?=$endereco->info['rua'];?>">
            <label for="">Número*:</label>
            <input type="text" name="num" id="num" class="form-control" placeholder="Numero" value="<?=$endereco->info['num'];?>">
        </div>
        <div class="form-group">
            <label for="">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" value="<?=$endereco->info['bairro'];?>">
            <label for="">Cidade:</label> 
            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="<?=$endereco->info['cidade'];?>">
            <label for="">UF:</label>
            <input type="text" name="uf" id="uf" class="form-control" placeholder="UF" value="<?=$endereco->info['uf'];?>">
        </div>
        <div class="form-group">
            <label for="">Fone:</label>
            <input type="text" name="fone1" id="fone1" class="form-control" placeholder="Fone" value="<?=$pessoa->info['fone1'];?>">
            <label for="">Celular:</label> 
            <input type="text" name="fone2" id="fone2" class="form-control" placeholder="Celular" value="<?=$pessoa->info['fone2'];?>">
            <label for="">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$pessoa->info['email'];?>">
        </div>
        <div class="form-group">
            <label for="">Profissão:</label>
            <select name="profissao" id="" class="form-control">
                <option value="<?=$pro->info['id'];?>"><?=$pro->info['nome'];?></option>
                <?php foreach($profissao->info as $pro):?>
                    <option value="<?=$pro['id'];?>"><?=$pro['nome'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber <strong>Publicações?</strong> </label><br>
            <input type="radio" name="recpub" value="1" <?=$pessoa->info['recpub'] == '1' ? 'checked': '';?>>Sim <br>
            <input type="radio" name="recpub" value="0" <?=$pessoa->info['recpub'] == '0' ? 'checked': '';?>>Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber a <strong>Imagem?</strong> </label><br>
            <input type="radio" name="recimgpel" value="1" <?=$pessoa->info['recimgpel'] == '1' ? 'checked': '';?>>Sim <br>
            <input type="radio" name="recimgpel" value="0" <?=$pessoa->info['recimgpel'] == '0' ? 'checked': '';?>>Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber Convite para <strong> Eventos?</strong></label><br>
            <input type="radio" name="conviteev" value="1" <?=$pessoa->info['conviteev'] == '1' ? 'checked': '';?>>Sim <br>
            <input type="radio" name="conviteev" value="0" <?=$pessoa->info['conviteev'] == '0' ? 'checked': '';?>>Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber Convite para <strong>Consagração?</strong> </label><br>
            <input type="radio" name="convitecos" value="1" <?=$pessoa->info['convitecos'] == '1' ? 'checked': '';?>>Sim <br>
            <input type="radio" name="convitecos" value="0" <?=$pessoa->info['convitecos'] == '0' ? 'checked': '';?>>Não <br>
        </div>
        <div class="form-group">
            <label for="">Já fez a consagração?</label><br>
            <input type="radio" name="consagracao" value="1" id="sim_consagracao" <?=$pessoa->info['con'] == '1' ? 'checked': '';?>>Sim <br>
            <input type="radio" name="consagracao" value="0" <?=$pessoa->info['con'] == '0' ? 'checked': '';?>>Não <br>
        </div>
        <div class="form-group group-consagracao">
            <label for="">Nº Turma:</label><br>
            <select name="turma" id="" class="form-control">
                <option value="<?=$consa->info['id'];?>"><?=$consa->info['turma']; ?></option>
                <?php foreach($consagracao->info as $con):?>
                    <option value="<?=$con['id'];?>"><?=$con['turma'];?></option>
                <?php endforeach;?>
            </select> <br>
            <label for=""><strong>Concluiu o Curso?</strong> </label>
            <input type="radio" name="concluiu" id="" value="1" <?=$pc->info['concluido'] == '1' ? 'checked': '';?>>Sim
            <input type="radio" name="concluiu" id="" value="0" <?=$pc->info['concluido'] == '0' ? 'checked': '';?>>Não

            <label for=""><strong>Deseja Renovar o Curso?</strong> </label>
            <input type="radio" name="renovou" id="" value="1" <?=$pc->info['renovacao'] == '1' ? 'checked': '';?>>Sim
            <input type="radio" name="renovou" id="" value="0" <?=$pc->info['renovacao'] == '0' ? 'checked': '';?>>Não
        </div>
        <div class="form-group">
            <input type="submit" value="Atualizar" class="form-control btn btn-success">
        </div>
        
    </form>
    <hr>
    <br>
    <h2>Visitas Cadastradas</h2>
    <hr>
    <table class="table table-striped table-hovertable-responsive-sm">
        <thead>
            <tr>
                <th>Data</th>
                <th>Dupla</th>
                <th>Resultado</th>
                <th>Parcelas</th>
                <th>Valor</th>
            </tr>
        </thead>
        <?php if($visita->info == null): ?>
            <div class="alert alert-info">Nenhum registro Encontrado!</div>
        <?php else: ?>
        <?php foreach($visita->info as $vis):?>
        <tbody>
            <tr>
                <td><?=date('d/m/Y', strtotime($vis['data']));?></td>
                <td>
                    <?=$dupla->getOne($vis['id_dupla'])['nome1'].' - '.$dupla->getOne($vis['id_dupla'])['nome2'];?>
                </td>
                <td><?=$vis['resultado'] == '1' ? 'Doação' : 'Recusa';?></td>
                <td><?=$vis['n_parcela'];?></td>
                <td><?=number_format($vis['valor'], 2, ',', ' ');?></td>
            </tr>

        </tbody>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div> 