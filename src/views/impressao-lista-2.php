<h1>Impressão - <?=date('d/m/Y'). ' - '. $titulo;?></h1>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>Fone 1</th>
            <th>Fone 2</th>
            <th>Profissão</th>
            <th>CEP</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Região</th>
            <th>Rua</th>
            <th>Número</th>
        </tr>
    </thead>
    <?php if($pessoa->info == null):?>
        <div>
            Nenhum registro encontado!
        </div>
    <?php else:?>
    <?php foreach($pessoa->info as $pes):?>
    <tbody>
        <?php $endereco->getOne($pes['id_endereco']);?>
        <?php $profissao->getOne($pes['id_profissao']);?>
        <?php $regiao->getOne($endereco->info['id_regiao']);?>
        <tr>
            <td><?=$pes['id'];?></td>
            <td><?=$pes['nome'];?></td>
            <td>
                <?=($pes['nascimento'] != '0000-00-00') ? date('d/m/Y', strtotime($pes['nascimento'])) : 'Não registrado!' ;?>
            </td>
            <td><?=$pes['fone1'];?></td>
            <td><?=$pes['fone2'];?></td>
            <td><?=$profissao->info['nome'];?></td>
            <td><?=$endereco->info['cep'];?></td>
            <td><?=$endereco->info['cidade'];?></td>
            <td><?=$endereco->info['bairro'];?></td>
            <td><?=$regiao->info['zona'];?></td>
            <td><?=$endereco->info['rua'];?></td>
            <td><?=$endereco->info['num'];?></td>
        </tr>
        
        <tr style="border-top: 15px solid #ffffff;
            float: left;
            width:100%;">
        </tr>
    </tbody>
    <?php endforeach;?>
    <?php endif;?>
</table>  