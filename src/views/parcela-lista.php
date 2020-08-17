<div class="row lista">
    <h1>Controle de Parcelas</h1>
    <hr>
    <h4>Data da Visita: <?=date('d/m/Y', strtotime($visita->info['data']));?></h4>
    <br>
    <h6>Nome Visitado: <?=$pessoa->info['nome'];?> - Forma de Pagamento:  <?=$pg->info['pagamento'];?></h6>
    <div class="alert alert-info">
        Total pago: R$ <?=number_format($total_pago, 2, ',', '.') ;?>
    </div>
    <div class="alert alert-info">
        Total a pagar: R$ <?=number_format($total_pagar, 2, ',', '.') ;?>
    </div>
    <table class="table table-striped table-hovertable-responsive-sm">
        <thead>
            <tr>
                <th>Nº da Parcela</th>
                <th>Vencimento</th>
                <th>Controle de Pagamento</th>
                <th>Status</th>
                <th>Valor da parcela</th>
                <th>Excluir Parcela</th>
            </tr>
        </thead>
        <?php foreach($parcela->info as $par):?>
        <tbody>
            <tr>
                <td><?=$par['n_parcela'];?></td>
                <td><?=date('d/m/Y', strtotime($par['vencimento']));?></td>
                <td>
                    <?php if($par['pagamento'] == '1'):?>
                        
                        <button id="" class="btn btn-danger desmarcar_pagamento" data-id="<?=$par['id'];?>">Desmarcar Pagamento</button>
                    <?php else:?>
                        <button id="" class="btn btn-info marcar_pagamento" data-id="<?=$par['id'];?>">Marcar Pagamento</button>
                    <?php endif;?>
                </td>
                <td>
                    <?php if($par['pagamento'] == '1'):?>
                        <img src="<?=BASE_URL;?>assets/images/check.png" alt="" width="30">
                    <?php else: ?>
                        <img src="<?=BASE_URL;?>assets/images/criss-cross.png" alt="" width="30">
                    <?php endif; ?>
                    
                </td>

                <td>
                    R$ <?=number_format($visita->info['valor'], 2, ',', '.') ;?>
                </td>
                <td>
                    <a onclick="return confirm('Tem certeza que deseja deletar a parcela!?');" href="<?=BASE_URL;?>deletar/parcela/<?=$par['id'];?>">
                        <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="" width="30">
                    </a>
                </td>
            </tr>
        </tbody>
        <?php endforeach;?>
    </table>
</div>