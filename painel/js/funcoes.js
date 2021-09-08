var caminho = "", contIngresso = 0, valorTotal = 0, taxa = 0, Height = 0, Width = 0, cont = 0;
$(document).ready(function ($) {
    caminho = $("#caminho").val();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tipo-pessoa').bootstrapToggle({
        on: 'Física',
        off: 'Juridica'
    });
    $('#status-cliente').bootstrapToggle({
        on: 'Sim',
        off: 'Não'
    });
    $('#status-bicicleta').bootstrapToggle({
        on: 'Sim',
        off: 'Não'
    });
    $("#datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
    $("#datepicker1").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad|android)/);
    if (agentID) {
        $('#datatable-buttons').dataTable({
            "info": true,
            "searching": true,
            language: {
                search: "",
                searchPlaceholder: "Filtrar..."
            }
        });
    } else {
        $('#datatable-buttons').dataTable({
            "info": true,
            "searching": true,
            language: {
                search: "",
                searchPlaceholder: "Filtrar..."
            },
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    }


    $("#divCarregando").show();
    $(window).load(function () {
        $('#divCarregando').fadeOut('slow');
    });
    //Chamar pagina novo cadastro
    $("#novo-cad").click(function () {
        location.href = '?pg=' + $('#area').val();
    });
    //Voltar da pagina de novo cadastro
    $("#voltar").click(function () {
        location.href = '?pg=' + $('#area').val();
    });

    //Enviar formulario para novo cadastro
    $("#formulario").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        if ($('#area').val() === 'check') {
            formData.append('itens', $('input[name=itens]:checked').map(function () {
                return this.value;
            }).get().join(","));
        }

        $.ajax({
            beforeSend: function () {
                $('#divCarregando').fadeIn();
            },
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#divCarregando').fadeOut('slow');
                //alert(data);
                if (data === 'trueSalvar') {
                    msgSucess('Cadastro feito com sucesso!');
                    setTimeout(function () {
                        window.location.href = "?pg=" + $("#area").val();
                    }, 5000);
                } else if (data === 'trueAlterar') {
                    msgSucess('Alteração feito com sucesso!');
                    setTimeout(function () {
                        window.location.href = "?pg=" + $("#area").val();
                    }, 5000);
                } else if (data === 'errorEmail') {
                    msgError('E-mail ja existente !');
                } else if (data === 'erroTelefone') {
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
    //Clicar na linha tabela e chamar para alteração
    var timer = 0;
    var delay = 200;
    var prevent = false;
    $("table tbody tr")
            .on("click", function () {
                $(this).removeClass("even");
                $(this).removeClass("odd");
                var tr = $(this);
                timer = setTimeout(function () {
                    if (!prevent) {
                        selecionar(tr.attr("class"), tr);
                    }
                    prevent = false;
                }, delay);
            })
            .on("dblclick", function () {
                var tr = $(this);
                clearTimeout(timer);
                prevent = true;
                var id = tr.attr("class");
                window.location.href = "?pg=" + $("#area").val() + '&id=' + id;
            });
    //Chamar Alterar dados
    $("#btn-alterar").click(function () {
        if (arrayId.length > 1) {
            $("#mi-modal-alterar").modal('show');
            return;
        } else {
            window.location.href = "?pg=" + $("#area").val() + '&id=' + arrayId[0];
        }
    });
    // Chamar confirm Excluir item 
    var modalConfirm = function (callback) {

       
        $("#btn-confirm").on("click", function () {
            $("#mi-modal").modal('show');
        });
        $("#modal-btn-si").on("click", function () {
            callback(true);
            $("#mi-modal").modal('hide');
        });
        $("#modal-btn-no").on("click", function () {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };
    // Result confirm Excluir item
    modalConfirm(function (confirm) {
        if (confirm) {
            var ids = '';
            if (arrayId.length > 0) {
                jQuery.each(arrayId, function (i, val) {
                    ids += val + ',';
                });
                $.ajax({
                    beforeSend: function () {
                        $('#divCarregando').fadeIn();
                    },
                    url: 'view/' + caminho + '/excluir.php',
                    data: {id: ids},
                    type: 'POST',
                    dataType: "html",
                    success: function (data) {
                        $('#divCarregando').fadeOut('slow');
                        alert(data);
                        if (data !== 'erro') {
                            msgSucess("Cadastro excluido com sucesso!");
                            setTimeout(function () {
                                window.location.reload();
                            }, 5000);
                        } else {
                            msgError('Erro ao tentar excluir!');
                        }
                    }, error: function (request, status, error) {
                        var err = eval("(" + request.responseText + ")");
                        $('#divCarregando').fadeOut('slow');
                        msgError(err);
                    }
                });
            }
        } else {
            //alert("NO CONFIRMADO");
        }
    });



    // Modal para exibir os endereços dos clientes (clientes.php)
    $("#btn-ver-enderecos").click(function () {
        $.ajax({
            beforeSend: function () {
                //$('#divCarregando').fadeIn();
            },
            url: 'modal-endereco.php',
            type: 'POST',
            data: {idEndereco: arrayId[0]},
            success: function (data) {
                //alert(data);
                $('#modal-endereco').html(data);
                $('#modal-ver-enderecos').modal('show');
                $('#datatable-buttons-endereco').dataTable({
                    "info": true,
                    "searching": true,
                    language: {
                        search: "",
                        searchPlaceholder: "Filtrar..."
                    },
                    dom: 'Bfrtip',
                });
            }, error: function (request, status, error) {
                var err = eval("(" + request.responseText + ")");
                $('#divCarregando').fadeOut('slow');
                msgError(err);
            }
        });
        return false;
    });

    //Preencher cidade ao escolher estado
    $('#estado').change(function () {
        if ($(this).val()) {
            $('#divCarregando').fadeIn();
            $.getJSON(
                    'view/cliente/json_cidade.php?estado=' + $(this).val(),
                    function (j) {
                        var options = '<option value="">Selecione</option>';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' +
                                    j[i].id + '">' +
                                    decodeURIComponent(escape(j[i].nome)) + '</option>';
                        }
                        $('#cidades').html(options).show();
                        $('#divCarregando').fadeOut('slow');
                    });
        }
    });
    $("#taxa").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: '',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: true
    });
    $("#valor").inputmask('currency', {
        "autoUnmask": true,
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: '',
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: true
    });
    $("#modalidade-param").change(function () {
        if ($(this).val() === "km") {
            $('#lblkm').html("KM *");
        } else {
            $('#lblkm').html("HORAS *");
        }
    });
    verifica_horario();
});
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

//selecionar e linhas para excluir e alterar
var arrayId = [], arrayIdEnd = [], colorAnterior;

function selecionar(id, tr) {
    if ($.inArray(id, arrayId) !== -1) {
        if (arrayId.indexOf(id) !== -1) {
            arrayId.splice(arrayId.indexOf(id), 1);
        }
        tr.css('background', colorAnterior);
    } else {
        colorAnterior = tr.css('backgroundColor');

        arrayId.push(id);
        tr.css('background', "#000000");
    }

    if (arrayId.length === 0) {
        $('#btn-alterar').hide();
        $('#btn-confirm').hide();
        $('#btn-ver-enderecos').hide(); // botão para ver o endereço do cliente
        $('#btn-opcoes-pedido').show(); // botão para ver o endereço do cliente
    } else {
        $('#btn-alterar').show();
        $('#btn-confirm').show();
        $('#btn-ver-enderecos').show(); // botão para ver o endereço do cliente
        $('#btn-opcoes-pedido').show(); // botão para ver o endereço do cliente
    }
}

function selecionarEnd(id, tr) {
    if ($.inArray(id, arrayIdEnd) !== -1) {
        if (arrayIdEnd.indexOf(id) !== -1) {
            arrayIdEnd.splice(arrayIdEnd.indexOf(id), 1);
        }
        tr.css('background', colorAnterior);
    } else {
        colorAnterior = tr.css('backgroundColor');
        arrayIdEnd.push(id);
        tr.css('background', "#000000");
    }

    if (arrayId.length === 0) {
        $('#btn-alterar').hide();
        $('#btn-confirm').hide();
        $('#btn-ver-enderecos').hide(); // botão para ver o endereço do cliente
        $('#btn-opcoes-pedido').show(); // botão para ver o endereço do cliente
    } else {
        $('#btn-alterar').show();
        $('#btn-confirm').show();
        $('#btn-ver-enderecos').show(); // botão para ver o endereço do cliente
        $('#btn-opcoes-pedido').show(); // botão para ver o endereço do cliente
    }
}

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("BSbtnsuccess").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

function abrirFile(event) {
    event.preventDefault();
    $('#BSbtnsuccess').click();
}

function abrirTelaLogin() {
    var selectedEffect = "explode";
    $("#effect").css('left', (Width - 500) / 2);
    $("#effect").css('top', 50);
    $("#effect").show(selectedEffect);
    $("#cadastrar").hide();
}

function abrirTelaCadastrar() {
    var selectedEffect = "explode";
    $("#cadastrar").css('left', (Width - 500) / 2);
    $("#cadastrar").css('top', 50);
    $("#cadastrar").show(selectedEffect);
    $("#effect").hide();
}

function abrirTela(parametro, evento) {
    evento.preventDefault();
    abrirModal();
    if (parametro === 'login') {
        abrirTelaLogin();
    } else {
        abrirTelaCadastrar();
    }
    disableScrolling();
}

function fecharTela(parametro, event) {
    event.preventDefault();
    if (parametro === 'login') {
        $("#effect").hide();
    } else {
        $("#cadastrar").hide();
    }
    fecharModal();
    enableScrolling();
}

function disableScrolling() {
    $(document).scrollTop(0);
    var x = window.scrollX;
    var y = document.scrollY;
    window.onscroll = function () {
        window.scrollTo(x, y);
    };
}

function enableScrolling() {
    window.onscroll = function () { };
}

function abrirModal() {
    Height = $(document).height();
    Width = $(window).width();
    $('#modal').css({'width': Width, 'height': Height});
    $('#modal').fadeIn();
}

function fecharModal() {
    $('#modal').hide();
}

function logout() {
    if (confirm('Deseja realmente sair do Deslogar?')) {
        location.href = '?pg=logout';
    }
}

function selecionarKM(km) {
    $('#btnKM').html(km);
    $('#kmselect').val(km);
}

function selecionarKM2(km) {
    $('#btnKM1').html(km);
    $('#kmselect1').val(km);
}

function alterarRevisao(id, url) {
    event.preventDefault();
    $.ajax({
        url: 'alt_revisao.php',
        data: {id: id},
        type: 'POST',
        dataType: "html",
        success: function (retorno) {
            //alert(retorno);

            var link = document.createElement('a');
            link.href = url;
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            delete link;
            window.location.reload();
        }, error: function (request, status, error) {
            var err = eval("(" + request.responseText + ")");
        }
    });
}

function verifica_horario() {
    now = new Date
    if (now.getHours() >= 0 && now.getHours() < 5) {
        $("#bemVindo").html("Boa noite, ");
    } else if (now.getHours() >= 5 && now.getHours() < 12) {
        $("#bemVindo").html("Bom dia, ");
    } else if (now.getHours() >= 12 && now.getHours() < 18) {
        $("#bemVindo").html("Boa tarde,");
    } else {
        $("#bemVindo").html("Boa noite, ");
    }
}

function abrirEndereco() {
    window.location.href = "?pg=" + $("#area-endereco").val() + '&idcliente=' + arrayId[0];
}



var timerEnd = 0;
var delayEnd = 200;
var preventEnd = false;
var id_endereco_selecionado=0;
function seleciona_endereco_cliente() {
    $("#datatable-buttons-endereco tbody tr")
            .on("click", function () {
                $(this).removeClass("even");
                $(this).removeClass("odd");
                var tr = $(this);

                timerEnd = setTimeout(function () {
                    if (!preventEnd) {
                        selecionarEnd(tr.attr("class"), tr);
                        id_endereco_selecionado = tr.attr("class");
                    }
                    preventEnd = false;
                }, delayEnd);
            })
            .on("dblclick", function () {
                var tr = $(this);
                clearTimeout(timerEnd);
                preventEnd = true;
                id_endereco_selecionado = tr.attr("class");
                window.location.href = "?pg=" + $("#area-endereco").val() + '&idcliente=' + arrayId[0]+'&idendereco='+id_endereco_selecionado;
            });
}

function alterar_endereco_cliente() {
    window.location.href = "?pg=" + $("#area-endereco").val() + '&idcliente=' + arrayId[0]+'&idendereco='+id_endereco_selecionado;
}

function excluirEndereco() {
    $('.btn-confirm').on('click',function(){
        $("#modal-excluir-endereco").modal('show');
    });
}


