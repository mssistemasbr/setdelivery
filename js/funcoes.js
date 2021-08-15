/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function ($) {
    var myCarousel = document.querySelector('#carouselExampleControls');
    var carousel = new bootstrap.Carousel(myCarousel, {
        ride: false,
        pause: false
    });

    $('.carousel-control-prev').click(function () {
        alert("prev");
        carousel('prev');
    });

    $('.carousel-control-next').click(function () {
        alert("next");
        carousel('next');
    });

    //Enviar formulario para novo cadastro
    $("#formulario").submit(function (event) {
        event.preventDefault();

        validaCamposCad();

        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            beforeSend: function () {
                //$('#divCarregando').fadeIn();
            },
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //$('#divCarregando').fadeOut('slow');
                $("#teste").html(data);

                if (data === 'trueSalvar') {
                    msgSucess('Cadastro feito com sucesso!');
                    setTimeout(function () {
                        // window.location.href = "?pg=" + $("#area").val();
                        // ja fazer o login automatico.
                    }, 5000);
                } else if (data === 'errorEmail') {
                    msgError('E-mail ja existente !');
                } else {
                    msgError('Erro ao tentar cadastrar ou alterar! ' + data);
                }
            }, error: function (request, status, error) {
                var err = eval("(" + request.responseText + ")");
                $('#divCarregando').fadeOut('slow');
                msgError(err);
            }
        });
        return false;
    });


});

function validaCamposCad() {
    $('#modalAlertCadastrar').modal("show");

    if ($("#nome").val() === "") {
        $('#modalAlertCadastrar .modal-body').html("Nome não informado.");
        return;
    }

    if ($("#email").val() === "") {
        $('#modalAlertCadastrar .modal-body').html("E-mail não informado.");
        return;
    }

    if ($("#celular").val() === "") {
        $('#modalAlertCadastrar .modal-body').html("Celular não informado.");
        return;
    }

    if ($("#senha").val() === "") {
        $('#modalAlertCadastrar .modal-body').html("Senha não informado.");
        return;
    }
}

function msgSucess(msg) {
    $('#msg-sucess strong').text(msg);
    $('#msg-sucess').fadeIn('slow');
    $('#msg-sucess').fadeOut(5000, "linear");
}

function msgError(msg) {
    $('#msg-error strong').text(msg);
    $('#msg-error').fadeIn('slow');
    $('#msg-error').fadeOut(5000, "linear");
}


