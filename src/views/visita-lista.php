<div class="row lista">
    <h1>Lista de Visitas</h1>
    <hr>
    <div class="alert alert-info">
        Total de visitas: <?=$visita->getTotalVisita()[0];?>,
        Visitas com doação: <?=$visita->getTotalVisitaResultado(1)[0];?>,
        Visitas sem doação: <?=$visita->getTotalVisitaResultado(0)[0];?>
    </div>
    <table class="table table-striped table-hovertable-responsive-sm">
        <div class="alert alert-info">Clique no Número de parcela para acessar o controle</div>
        <thead>
            <tr>
                <th>Data</th>
                <th>Dupla</th>
                <th>Resultado</th>
                <th>Parcelas</th>
                <th>Valor</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <?php $visita->getAll();?>
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
                <td>
                    <?php if($vis['n_parcela'] == null || $vis['n_parcela'] == 0):?>
                        0
                    <?php else: ?>
                    <a href="<?=BASE_URL;?>lista/parcela/<?=$vis['id'];?>">
                        <?=$vis['n_parcela'];?>
                    </a>
                    <?php endif;?>
                </td>
                <td><?=number_format($vis['valor'], 2, ',', ' ');?></td>
                <td>
                    <a onclick="return confirm('Tem certeza que deseja deletar a visita com TODOS os REGISTROS!?');" href="<?=BASE_URL;?>deletar/visita/<?=$vis['id'];?>">
                        <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="" width="30">
                    </a>
                </td>
            </tr>

        </tbody>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>