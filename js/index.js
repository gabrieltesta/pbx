$(function () {
    //Ativa todas as tooltips
    $('[data-toggle="tooltip"]').tooltip();
    $("#btnLogin").click(function () {
        validateForm();
    })
})

//Função realiza validação do formulário
function validateForm() {
    var status = true;
    $(".alerts").html('');
    if($("#txtRamal").val() == '')
    {
        $(".alerts").append('<div class="alert alert-danger">O campo de número do ramal é obrigatório.</div>');
        status = false;
    }

    if($("#txtSenhaRamal").val() == '')
    {
        $(".alerts").append('<div class="alert alert-danger">O campo de senha é obrigatório.</div>');
        status = false;
    }

    if(status)
    {
        submitForm();
    }
}

//Função realiza o submit do formulário
function submitForm() {
    $("#form-login").submit();
}
