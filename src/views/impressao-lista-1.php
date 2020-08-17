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
            <td><?=$endereco->info['rua'];?></td>
            <td><?=$endereco->info['num'];?></td>
        </tr>
        
        <?php if($visita->getByIdPessoa($pes['id']) == true):?>
        <tr>
            <th>Data Visita</th>
            <th colspan=2>Dupla</th>
            <th colspan=2>Resultado</th>
            <th colspan=2>Valor</th>
            <th>Número de Parcelas</th>
            <th colspan=3>Total</th>
        </tr>
        
        <?php foreach($visita->info as $vis):?>
            <?php $dupla->getOne($vis['id_dupla']);?>
        <tr>
            <td><?=date('d/m/Y', strtotime($vis['data'])) ;?></td>
            <td colspan=2><?=$dupla->info['nome1']. ' - ' .$dupla->info['nome2'];?></td>
            <td colspan=2>
                <?=$vis['resultado'] == '1' ? 'Doação' : 'Recusa';?>
            </td>
            <td colspan=2> <?=number_format($vis['valor'], 2, ',', '.') ;?></td>
            <td><?=$vis['n_parcela'];?></td>
            <td colspan=3>
                <?=number_format(
                    intval($vis['n_parcela']) * intval($vis['valor']), 
                    2, ',', '.');?>
            </td>
        </tr>
        <tr style="border-top: 15px solid #ffffff;
            float: left;
            width:100%;">
            
        </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
    <?php endforeach;?>
    <?php endif;?>
</table>  
    