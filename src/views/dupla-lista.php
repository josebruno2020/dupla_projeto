<div class="row lista">
    <h1>Duplas Cadastradas</h1>
    <hr>
    <div id="resultado">
        <table class="table table-striped table-hovertable-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sant'Elmo</th>   
                    <th>Retaguarda</th>                 
                </tr>
            </thead>
            <?php if($dupla->info == null):?>
                <div class="alert alert-info">
                    Nenhum registro encontado!
                </div>
            <?php else:?>
            <?php foreach($dupla->info as $d):?>
            <tbody>
                <tr>
                    <td><?=$d['id'];?></td>
                    <td><?=$d['nome1'];?></td>
                    <td>
                        <?=$d['nome2'];?>   
                    </td>
                </tr>
            </tbody>
            <?php endforeach;?>
            <?php endif;?>
        </table>   
          
    </div>
    
</div>