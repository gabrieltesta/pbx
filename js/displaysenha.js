/*
    Arquivo Javascript que contém funções relacionadas a página displaysenha.php
*/
$(function () {
    $("#senha-gerada").click(function () {
        copiar();
    })
})

//Função copia a senha gerada 
function copiar() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($("#senha-gerada").text()).select();
    document.execCommand("copy");
    $temp.remove();

    $("#senha-gerada").css('color', 'green');
}
