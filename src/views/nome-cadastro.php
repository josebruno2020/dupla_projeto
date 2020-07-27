<div class="row cadastro">
    <h1>Cadastro - Novo Nome</h1>
    <hr><br>
    <form action="<?=BASE_URL;?>cadastro/nomeAction" method="POST" class="form">
        <?php if(!empty($flash)):?>
        <div class="alert alert-info">
            <?=$flash;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            <label for="">Nome*:</label> 
            <input type="text" name="nome" id="" class="form-control" placeholder="Nome">
            <label for="">Nascimento:</label> 
            <input type="date" name="nascimento" id="" class="form-control">    
        </div>
        <div class="form-group">
            <label for="">CEP*:  </label>
            <input type="text" name="cep" id="cep" class="form-control" placeholder="00000-000">
            <label for="">Rua:</label> 
            <input type="text" name="rua" id="rua" class="form-control" placeholder="Rua">
            <label for="">Número*:</label>
            <input type="text" name="num" id="num" class="form-control" placeholder="Numero">
        </div>
        <div class="form-group">
            <label for="">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro">
            <label for="">Cidade:</label> 
            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
            <label for="">UF:</label>
            <input type="text" name="uf" id="uf" class="form-control" placeholder="UF">
        </div>
        <div class="form-group">
            <label for="">Fone:</label>
            <input type="text" name="fone1" id="fone1" class="form-control" placeholder="Fone">
            <label for="">Celular:</label> 
            <input type="text" name="fone2" id="fone2" class="form-control" placeholder="Celular">
            <label for="">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="">Profissão:</label>
            <select name="profissao" id="" class="form-control">
                <option value=""></option>
                <?php foreach($profissao->info as $pro):?>
                    <option value="<?=$pro['id'];?>"><?=$pro['nome'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber <strong>Publicações?</strong> </label><br>
            <input type="radio" name="recpub" value="1">Sim <br>
            <input type="radio" name="recpub" value="0">Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber a <strong>Imagem?</strong> </label><br>
            <input type="radio" name="recimgpel" value="1">Sim <br>
            <input type="radio" name="recimgpel" value="0">Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber Convite para <strong> Eventos?</strong></label><br>
            <input type="radio" name="conviteev" value="1">Sim <br>
            <input type="radio" name="conviteev" value="0">Não <br>
        </div>
        <div class="form-group">
            <label for="">Deseja Receber Convite para <strong>Consagração?</strong> </label><br>
            <input type="radio" name="convitecos" value="1">Sim <br>
            <input type="radio" name="convitecos" value="0">Não <br>
        </div>
        <div class="form-group">
            <label for="">Já fez a consagração?</label><br>
            <input type="radio" name="consagracao" value="1" id="sim_consagracao">Sim <br>
            <input type="radio" name="consagracao" value="0">Não <br>
        </div>
        <div class="form-group group-consagracao">
            <label for="">Nº Turma:</label><br>
            <select name="turma" id="" class="form-control">
                <option value=""></option>
                <?php foreach($consagracao->info as $con):?>
                    <option value="<?=$con['id'];?>"><?=$con['turma'];?></option>
                <?php endforeach;?>
            </select> <br>
            <label for=""><strong>Concluiu o Curso?</strong> </label>
            <input type="radio" name="concluiu" id="" value="1">Sim
            <input type="radio" name="concluiu" id="" value="0">Não

            <label for=""><strong>Deseja Renovar o Curso?</strong> </label>
            <input type="radio" name="renovou" id="" value="1">Sim
            <input type="radio" name="renovou" id="" value="0">Não
        </div>
        <div class="form-group">
            <input type="submit" value="Cadastrar" class="form-control btn btn-success">
        </div>
        
    </form>
</div> 
