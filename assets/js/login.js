setInterval(updateArea, 100);
function updateArea() {
    var alturaTela = $(window).height();
    console.log(alturaTela);
    $('.fundo-img').css('height', alturaTela+'px');
    $('.blur').css('height', alturaTela+'px');
};
//Funçao para mostrar a senha;
$('#mostrar_senha').click(function(){

    if($('#mostrar_senha').is(':checked')){
        $('#input_senha').attr('type', 'text');
    } else{
        $('#input_senha').attr('type', 'password');
    }
});