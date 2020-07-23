setInterval(updateArea, 100);
function updateArea() {
    var alturaTela = $(window).height();
    console.log(alturaTela);
    $('.fundo-img').css('height', alturaTela+'px');
    $('.blur').css('height', alturaTela+'px');
};