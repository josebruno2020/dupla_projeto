var alturaTela = $(window).height();
$('.menu').css('height', alturaTela+'px');

$('.menu').hover(function(){
    $(this).css('width', 'auto');
    $('.drop-item a').css('display', 'block');
    $('.menu-item a').css('display', 'block');
    $('.dropdown-menu-item').css('display', 'none');
}, function(){
    $(this).css('width', '50px');
    $('.drop-item a').css('display', 'none');
    $('.menu-item a').css('display', 'none');

});
$('li').hover(function(){
    $(this).find('.dropdown-menu-item').show('fast');
}, function(){
    $(this).find('.dropdown-menu-item').hide('fast');
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
        } else{
            $('.group-consagracao').hide();
        }
        
    });
    //Formulario de cadastrar visita, quando o resultado é positivo, aparece os outros campos;
    $('#sim_resultado').click(function(){
        if($(this).prop('checked') == true){
            $('.group-resultado').css('display', 'flex');

        } else{

            $('.group-resultado').hide();
        }
        
    });

});

$('#marcar_pagamento').click(function(){
    //Recolhendo o id do pagamento;
    var id = $(this).attr('data-id');
    $(this).remove();

    $.ajax ({
        url:'/dupla_projeto/ajax/marcar_pagamento/'+id,
        type:'get'
    });
    location.reload();
});
