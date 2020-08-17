<div class="row lista">
    <h1>Impressão</h1>
    <hr>
    <div class="alert alert-info">
        Selecione os campos que deseja que seja impresso:
    </div>
    <form method="POST" action="<?=BASE_URL;?>impressao/impressao" id="form_impressao" class="form">
        <div class="form-group">
            <label for="">Filtros para nomes: </label>
            <select name="nome" id="" class="form-control" required>
                <option value=""></option>
                <option value="1">Todos os nomes</option>
                <option value="2">Nomes visitados</option>
                <option value="3">Nomes que não foram visitados</option>
            </select>

        </div>
        <div class="form-check form-check-inline">
            <label for="check_nome" class="form-check-label">Nome</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_nome" value="nome">

            <label for="check_nascimento" class="form-check-label">Nascimento</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_nascimento" value="nascimento">

            <label for="check_fone1" class="form-check-label">Telefone</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_fone1" value="fone1">

            <label for="check_fone2" label="form-check-label">Celular</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_fone2" value="fone2">

            <label for="check_email" label="form-check-label">E-mail</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_email" value="email">

            <label for="check_profissao" label="form-check-label">Profissão</label>
            <input type="checkbox" name="busca[]" class="form-check-input" id="check_profissao" value="id_profissao">
        </div>
        
        
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" value="Impressão">
        </div>
    </form>
</div>