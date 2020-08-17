<div class="row lista">
    <h1>Soldalícios Cadastrados</h1>
    <hr>
    <div id="resultado">
        <table class="table table-striped table-hovertable-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>   
                    <th>Deletar</th>                 
                </tr>
            </thead>
            <?php if($soldalicio->info == null):?>
                <div class="alert alert-info">
                    Nenhum registro encontado!
                </div>
            <?php else:?>
            <?php foreach($soldalicio->info as $sol):?>
            <tbody>
                <tr>
                    <td><?=$sol['id'];?></td>
                    <td><?=$sol['nome'];?></td>
                    <td>
                        <a onclick="return confirm('Tem certeza que deseja deletar o soldalicio com TODOS os REGISTROS!?');" href="<?=BASE_URL;?>deletar/soldalicio/<?=$sol['id'];?>">
                            <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="Excluir" width="30" title="Excluir">
                        </a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach;?>
            <?php endif;?>
        </table>    
    </div>
    
</div>