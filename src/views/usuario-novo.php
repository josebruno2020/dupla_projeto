<div class="row cadastro">
    <h1>Novo Usuário - Cadastro</h1>
    <hr>

    <form action="<?=BASE_URL;?>cadastro/usuarioAction" method="post" class="form">
        <?php if(!empty($flash)):?>
            <div class="alert alert-info">
                <?=$flash;?>
            </div>
        <?php endif;?>

        <div class="form-group">
            <label for="">Nome*:</label>
            <input type="text" name="nome" id="" class="form-control" placeholder="Nome" required>
            <label for="">E-mail*:</label>
            <input type="email" name="email" id="" class="form-control" placeholder="E-mail" required>
        </div>
        
        <div class="form-group">
            <label for="">Data Nascimento:</label>
            <input type="date" name="nascimento" id="" class="form-control" placeholder="Nascimento">
            
            <label for="">Grupo*:</label>
            <select name="grupo" id="" class="form-control" required>
                <option value=""></option>
                <option value="1">1 - Administrador</option>
                <option value="2">2 - Usuário</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Senha*:</label>
            <input type="password" name="password1" id="input_senha" class="form-control" required placeholder="Digite sua Nova Senha"> 

            <label for="">Confirme sua Senha:</label>
            <input id="input_senha" type="password" name="password2" class="form-control" required placeholder="Confirme sua Nova Senha">
        </div>

        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
    </form>
</div>