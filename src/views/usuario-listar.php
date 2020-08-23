<div class="row lista">
    <h1>Listar Usuários</h1>
    <hr>

    <table class="table table-striped table-hovertable-responsive-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Grupo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php if($usuario->info == null):?>
            <div class="alert alert-info">
                Nenhum registro encontado!
            </div>
        <?php else:?>
        <?php foreach($usuario->info as $us):?>
        <tbody>
            <tr>
                <td><?=$us['id'];?></td>
                <td>
                    <?=$us['nome'];?>  
                </td>
                <td>
                    <?php if($us['nascimento'] == '0000-00-00'):?>
                        Não registrado!
                    <?php else:?>
                    <?=date('d/m/Y', strtotime($us['nascimento']));?>
                    <?php endif;?>
                </td>
                <td>
                    <?php if($us['grupo'] == '1'):?>
                        Administrador
                    <?php else:?>
                        Usuário
                    <?php endif;?>
                </td>
                <td>
                    <a href="<?=BASE_URL;?>usuario/my/<?=$us['id'];?>" >
                        <img src="<?=BASE_URL;?>assets/images/edit.png" alt="Editar" width="30" title="Editar">
                    </a>
                    <?php if($us['id'] != $_SESSION['lgusuario']): ?>
                    <a onclick="return confirm('Tem certeza que deseja deletar o usuário com TODOS os REGISTROS!?');" href="<?=BASE_URL;?>deletar/usuario/<?=$us['id'];?>">
                        <img src="<?=BASE_URL;?>assets/images/deletar.png" alt="Excluir" width="30" title="Excluir">
                    </a>
                    <?php endif;?>
                </td>
            </tr>
        </tbody>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>