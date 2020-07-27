<div class="row lista">
    <h1>Nomes Cadastrados</h1>
    <hr>
    <table class="table table-striped table-hovertable-responsive-sm">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Fone 1</th>
                <th>Fone 2</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <?php if($pessoa->info == null):?>
            <div class="alert alert-info">
                Nenhum registro encontado!
            </div>
        <?php else:?>
        <?php foreach($pessoa->info as $pes):?>
        <tbody>
            <tr>
                <td><?=$pes['id'];?></td>
                <td>
                    <a href="<?=BASE_URL;?>lista/nome/<?=$pes['id'];?>"><?=$pes['nome'];?> </a> 
                </td>
                <td><?=($pes['nascimento'] != '0000-00-00') ? date('d/m/Y', strtotime($pes['nascimento'])) : 'Não registrado!' ;?></td>
                <td><?=$pes['fone1'];?></td>
                <td><?=$pes['fone2'];?></td>
                <td>
                    <a onclick="return confirm('Tem certeza que deseja deletar o nome com TODOS os REGISTROS!?');" href="<?=BASE_URL;?>deletar/nome/<?=$pes['id'];?>">
                        <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="" width="30">
                    </a>
                </td>
            </tr>
        </tbody>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>