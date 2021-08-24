/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var estagioPedido = 0, idTipoPizza = 0, idTamPizza = 0, idProduto = 0;
var idBordaPizza = 0, idAcrescimoPizza = 0, idItem = 0, obs, qtde = 1.0, valorTotal;

$(document).ready(function ($) {
    var myCarousel = document.querySelector('#carouselExampleControls');
    var carousel = new bootstrap.Carousel(myCarousel, {
        ride: false,
        pause: false
    });

    if (estagioPedido === 0) {
        $('.carousel-control-prev').html("Cancelar");
    }

    $('.carousel-control-prev').click(function () {
        if (estagioPedido === 0) {
            alert("fechar modal");
        } else {
            estagioPedido--;
            if (estagioPedido === 0) {
                $('.carousel-control-prev').html("Cancelar");
            }
            $('.carousel').carousel('prev');
            $('.carousel-control-next').html("Avançar");
        }
    });

    $('.carousel-control-next').click(function () {
        if (estagioPedido === 5) {
            salvarItemPedido();
            alert("finalizar pedido");
        } else if (estagioPedido === 0) {
            validaTipoPizza();
        } else if (estagioPedido === 1) {
            validaTamanhoPizza();
        } else if (estagioPedido === 2) {
            validaProdutoPizza();
        } else if (estagioPedido === 3) {
            validaProdutoBorda();
        } else if (estagioPedido === 4) {
            validaProdutoAcrescimo();
            $('.carousel-control-next').html("Finalizar");
        } else if (estagioPedido === 5) {
            validaProdutoObs();
        }
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
                alert(data);
                if (data === 'trueSalvar') {
                    msgSucess('Cadastro feito com sucesso!');
                    setTimeout(function () {
                        // window.location.href = "?pg=" + $("#area").val();
                        // ja fazer o login automatico.
                    }, 5000);
                } else if (data === 'trueAlterar') {
                    msgSucess('Alteração feito com sucesso!');
                    setTimeout(function () {
                        // window.location.href = "?pg=" + $("#area").val();
                        // ja fazer o login automatico.
                    }, 5000);
                } else if (data === 'errorEmail') {
                    msgError('E-mail já existente !');
                } else if (data.trim() === 'erroTelefone') {
                    msgError('Telefone celular já existente !');
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

function somaQtdeItem(parametro, inputQtd) {
    if (parametro === 0) {
        $('input[type=text][name=' + inputQtd + ']').val(parseFloat($('input[type=text][name=' + inputQtd + ']').val()) + 1);
        $('#valor-total').html(parseFloat($('#valor-total').html()) + parseFloat($('#valor-item-' + inputQtd).val()));
    } else {
        if ($('input[type=text][name=' + inputQtd + ']').val() > 0) {
            $('input[type=text][name=' + inputQtd + ']').val(parseFloat($('input[type=text][name=' + inputQtd + ']').val()) - 1);
            $('#valor-total').html(parseFloat($('#valor-total').html()) - parseFloat($('#valor-item-' + inputQtd).val()));
        }
    }
}

function validaTipoPizza() {
    if ($("input[type='radio'][name='rdTipoPiza'").is(":checked")) {
        $.each($("input[type='radio'][name='rdTipoPiza'"), function (id, val) {
            if ($(val).is(":checked")) {
                idTipoPizza = $(this).attr('value');
                $('.carousel').carousel('next');
                estagioPedido++;
                $('.carousel-control-prev').html("Voltar");
            }
        });
    } else {
        alert("Escolha um tipo pizza.");
        return;
    }
}

function validaTamanhoPizza() {
    if ($("input[type='radio'][name='rdTamanhoPizza'").is(":checked")) {
        $.each($("input[type='radio'][name='rdTamanhoPizza'"), function (id, val) {
            if ($(val).is(":checked")) {
                idTamPizza = $(this).attr('value');
                $('.carousel').carousel('next');
                estagioPedido++;
            }
        });
    } else {
        alert("Escolha um tamanho pizza.");
        return;
    }
}

function validaProdutoPizza() {
    if ($("input[type='radio'][name='rdProdutoPizza'").is(":checked")) {
        $.each($("input[type='radio'][name='rdProdutoPizza'"), function (id, val) {
            if ($(val).is(":checked")) {
                idProduto = $(this).attr('value');
                $('.carousel').carousel('next');
                estagioPedido++;
            }
        });
    } else {
        alert("Escolha uma pizza.");
        return;
    }
}

function validaProdutoBorda() {
    if ($("input[type='radio'][name='rdProdutoBorda'").is(":checked")) {
        $.each($("input[type='radio'][name='rdProdutoBorda'"), function (id, val) {
            if ($(val).is(":checked")) {
                idBordaPizza = $(this).attr('value');
            }
        });
    }
    $('.carousel').carousel('next');
    estagioPedido++;
}

function validaProdutoAcrescimo() {
    if ($("input[type='radio'][name='rdProdutoAcrescimo'").is(":checked")) {
        $.each($("input[type='radio'][name='rdProdutoAcrescimo'"), function (id, val) {
            if ($(val).is(":checked")) {
                idAcrescimoPizza = $(this).attr('value');
            }
        });
    }
    $('.carousel').carousel('next');
    estagioPedido++;
}

function validaProdutoObs() {
    estagioPedido++;
}

function salvarItemPedido() {
    alert($("#obsPizza").val());
    $.ajax({
        url: 'painel/view/itemPedido/salvar.php',
        type: 'POST',
        data: {
            idItem: idItem,
            idPedido: 0,
            qtde: qtde,
            idProduto: idProduto,
            idTipoPizza: idTipoPizza,
            idTamPizza: idTamPizza,
            idAcrescimoPizza: idAcrescimoPizza === '' ? 'NULL' : idAcrescimoPizza,
            idBordaPizza: idBordaPizza === '' ? 'NULL' : idBordaPizza,
            obs: $("#obsPizza").val(),
            sessao: $("#idSessao").val()
        },
        beforeSend: function () {
            alert("ENVIANDO...");
        }
    }).done(function (msg) {
        alert(msg);
        carregarItensPedido();
    }).fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });
}

function carregarItensPedido() {
    $("#itens-pedido").html("");
    $('#valor-total').html("");
    $.ajax({
        url: 'itens_pedido.php',
        type: 'POST',
        data: {
            sessao: $("#idSessao").val()
        },
        beforeSend: function () {
            alert("Atualizando");
        }
    }).done(function (pedido) {
        //alert(pedido);
        var itens = pedido.split("|");
        $("#itens-pedido").html(itens[0] + '<button type="button" onclick="finalizarPedido();" class="btn btn-primary m-2 p-2">Finalizar Pedido</button>');
        $('#valor-total').html(parseFloat(itens[1]));
        valorTotal = parseFloat(itens[1]);
    }).fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });
}

function deletarItemPedido(id) {
    $.ajax({
        url: 'painel/view/itemPedido/excluir.php',
        type: 'POST',
        data: {
            id: id
        },
        beforeSend: function () {
            alert("Excluindo");
        }
    }).done(function (msg) {
        //alert(msg);
        if (msg === "1") {
            carregarItensPedido();
        }
    }).fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });
}

function finalizarPedido() {
    var qtde = '';
    $('#itens-pedido input#qtd-itens-pedido').each(function () {
        qtde += $(this).val() + ',';
    });
    alert($("#valor-total").html().trim());
    $.ajax({
        url: 'painel/view/pedido/salvar.php',
        type: 'POST',
        data: {
            idPedido: 0,
            qtde: qtde,
            valorPedido:$("#valor-total").html().trim(),
            idCliente: 1, //$("#idCliente").val(),
            sessao: $("#idSessao").val()
        },
        beforeSend: function () {
            alert("ENVIANDO PEDIDO...");
        }
    }).done(function (msg) {
        alert(msg);
    }).fail(function (jqXHR, textStatus, msg) {
        alert(msg);
    });
}

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