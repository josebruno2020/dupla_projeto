var alturaTela = $(window).height();
$('.menu').css('height', alturaTela+'px');

$('.menu').hover(function(){
    $(this).css('width', 'auto');
    $('.menu-item a').css('display', 'block');
}, function(){
    $(this).css('width', '50px');
    $('.menu-item a').css('display', 'none');

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
});