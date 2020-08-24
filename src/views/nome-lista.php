<div class="row lista">
    <h1>Nomes Cadastrados</h1>
    <hr>
        <form method="POST" class="form form-inline" id="form_lista">
            <input type="text" name="lista_nome" id="lista_nome" class="form-control" placeholder="Pesquise aqui..." autofocus="true">
            <input type="submit" value="Buscar" class="btn btn-info">
        </form>
    <div id="resultado">
        <table class="table table-striped table-hovertable-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Fone 1</th>
                    <th>Fone 2</th>
                    <th>Ações</th>
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
                        <?=$pes['nome'];?>  
                    </td>
                    <td><?=$pes['fone1'];?></td>
                    <td><?=$pes['fone2'];?></td>
                    <td>
                        <a href="<?=BASE_URL;?>cadastro/visita/<?=$pes['id'];?>">
                            <img src="<?=BASE_URL;?>assets/images/house.png" alt="Cadastrar Visita" width="30" title="Cadastrar Visita">
                        </a>
                        <a href="<?=BASE_URL;?>lista/nome/<?=$pes['id'];?>" >
                            <img src="<?=BASE_URL;?>assets/images/edit.png" alt="Editar" width="30" title="Editar Nome">
                        </a>

                        <a onclick="return confirm('Tem certeza que deseja deletar o nome com TODOS os REGISTROS!?');" href="<?=BASE_URL;?>deletar/nome/<?=$pes['id'];?>">
                            <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="Excluir" width="30" title="Excluir Nome">
                        </a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach;?>
            <?php endif;?>
        </table>
        <ul class="pagination">
            <?php for($q=1;$q<=$total_paginas;$q++): ?>
            <li class="<?php echo ($p==$q)?'active':''; ?>"><a href="<?=BASE_URL;?>?<?php
            $w = $_GET;
            $w['p'] = $q;
            echo http_build_query($w);
            ?>"><?php echo $q; ?></a></li>
            <?php endfor; ?>
        </ul>    
    </div>
    
</div>