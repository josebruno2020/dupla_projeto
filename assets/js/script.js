//Dropdown para menu
$('li').hover(function(){
    $(this).find('#dropdown').show();
}, function(){
    $(this).find('#dropdown').hide();
});

$(document).ready(function(){
    function limpa_formulario(){
        //Limpa os dados do formulário;
        $('#rua').val("");
        $('#bairro').val("");
        $('#cidade').val("");
        $('#uf').val("");
    }
    //Função para quando o cep perde o foco(blur);
    $('#cep').blur(function(){
        //Armazenar numa variável o valor sem dígitos
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se o campo não está vazio;
        if(cep != ''){
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)){
                //Preenche os campos do form com '...' enquanto a busca é realizada;
                $('#rua').val("...");
                $('#bairro').val("...");
                $('#cidade').val("...");
                $('#uf').val("...");

                //Consulta o Website viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
                    if(!("erro" in dados)){
                        //Atualiza o form com os valores encontrados;
                        $('#rua').val(dados.logradouro);
                        $('#bairro').val(dados.bairro);
                        $('#cidade').val(dados.localidade);
                        $('#uf').val(dados.uf);
                    } else{
                        //CEP pesquisado não encontrado;
                        limpa_formulario();
                        alert("CEP não encontrado!");
                    }
                });
            } else{
                //CEP é inválido!
                limpa_formulario();
                alert("Formato de CEP inválido!");
            }
        } else{
            //CEP não preenchido;
            limpa_formulario();
        }
    });

    //Formulario de novo nome, quando indica que a pessoa ja fez a consagracao, aparece o campo para preencher em qual turma;
    $('#sim_consagracao').click(function(){
        if($(this).prop('checked') == true){
            $('.group-consagracao').css('display', 'flex');
        } 
    });
    $('#nao_consagracao').click(function(){
        if($(this).prop('checked') == true){
            $('.group-consagracao').css('display', 'none');
        } 
    });
    //Formulario de cadastrar visita, quando o resultado é positivo, aparece os outros campos;
    $('#sim_resultado').click(function(){
        if($(this).prop('checked') == true){
            $('.group-resultado').css('display', 'flex');

        } 
    });
    $('#nao_resultado').click(function(){
        if($(this).prop('checked') == true){
            $('.group-resultado').css('display', 'none');

        } 
    });
    /*
    * Função com AJAX para buscar nome das pessoas na pagina de lista de nomes;
    * Author: José Bruno;
    */
    $('#lista_nome').bind('keyup', function(){
        $('#form_lista').submit(function(e){
            
            var txt = $(this).serialize();
            e.preventDefault();
    
            $.ajax({
                url:'/dupla_projeto/ajax/lista_filtrar/',
                type:'post',
                data:txt,
                success:function(data){
                    $('#resultado').empty().html(data);
                    console.log(txt);
                }
            });
    
            return false;
        });
    
        $('#form_lista').trigger('submit');
    
    });

    /*
    * Função com requisição AJAX para buscar o nome das pessoas na pagina de listagem de visitas;
    */
    $('#lista_visita').bind('keyup', function(){
        $('#form_lista_visita').submit(function(e){

            var txt = $(this).serialize();
            e.preventDefault();

            $.ajax({
                url:'/dupla_projeto/ajax/lista_filtrar_visita',
                type:'post',
                data:txt,
                success:function(data){
                    $('#resultado_visita').empty().html(data);
                    console.log(txt);
                }
            });
            return false;

        });
        $('#form_lista_visita').trigger('submit');
    });
    

});


/*
* Requisição para marcar pagamento -> pagina de parcela;
*/
$('.marcar_pagamento').click(function(){
    //Recolhendo o id do pagamento;
    var id = $(this).attr('data-id');
    

    $.ajax ({
        url:'/dupla_projeto/ajax/marcar_pagamento/'+id,
        type:'get'
    });
    location.reload();
});


/*
* Requisição para desmarcar pagamento;
*/
$('.desmarcar_pagamento').click(function(){

    var id = $(this).attr('data-id');
    
    $.ajax ({
        url:'/dupla_projeto/ajax/desmarcar_pagamento/'+id,
        type:'get'
    });
    location.reload();
});
