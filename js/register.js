$(function () {
    //Ativa todas as tooltips
    $('[data-toggle="tooltip"]').tooltip();
    $("#btnRegistrar").click(function () {
        validateForm();
    })
});

//Função realiza validação do formulário
function validateForm() {
    var status = true;
    $(".alerts").html('');
    if($("#txtNumeroRamal").val() == '')
    {
        $(".alerts").append('<div class="alert alert-danger">O campo de número do ramal é obrigatório.</div>');
        status = false;
    }

    //Verifica se é um número positivo
    if(/^[0-9]+$/.test($("#txtNumeroRamal").val()))
    {
        //Verifica se é maior que 0
        if($("#txtNumeroRamal").val() > 0)
        {
            status = true;
        }
        else
        {
            $(".alerts").append('<div class="alert alert-danger">O campo de número do ramal só aceita números maiores que 0.</div>');
            status = false;
        }
    }
    else
    {
        $(".alerts").append('<div class="alert alert-danger">O campo de número do ramal só pode conter números.</div>');
        status = false;
    }


    if($("#txtNomeUsuario").val() == '')
    {
        $(".alerts").append('<div class="alert alert-danger">O campo de nome do usuário é obrigatório.</div>');
        status = false;
    }

    if(!$("#chkConfirmacao").is(':checked'))
    {
        $(".alerts").append('<div class="alert alert-danger">É necessário confirmar a criação do ramal.</div>');
        status = false;
    }

    if(status == true)
    {
        submitForm();
    }
}

//Função realiza o submit do formulário
function submitForm() {
    $("#form-register").submit();
}
