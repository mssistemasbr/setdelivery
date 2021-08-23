<?php
$direitos = ' © 2021 | Todos os direitos reservados | 👀';
$delivery = ' - setDelivery ';

$titulo_login = utf8_decode("Formulario de Login");
$titulo_esqueceu_senha = utf8_decode('Esqueceu a senha');

$titulo_pagina = 'Painel Administrativo - Set Delivery';
?>

<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $titulo_pagina ?></title>

        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">

        <style>
            .progresso {
                display: none;
                position: fixed;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                background-color: white;
                height: 200px;
                width: 200px;
                background-image: url('img/loading.gif');
            }
            #msg-sucess,#msg-error{
                display: none;
            }
        </style>
    </head>

    <body class="login">
        <div id = "msg-sucess" class = "alert alert-success" role = "alert" style = "text-align: center">
            <strong></strong>
        </div>
        <div id = "msg-error" class = "alert alert-danger" role = "alert" style = "text-align: center">
            <strong></strong>
        </div>
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form id="formulario" action="fazer_login.php" method="post" enctype="multipart/form-data">
                            <h1><?php echo $titulo_login ?></h1>
                            <div>
                                <input type="text" id="user" class="form-control" name="user" placeholder="E-mail" required="" />
                            </div>
                            <div>
                                <input type="password" id="senha" class="form-control" name="senha" placeholder="Senha" required="" />
                            </div>
                            <div>
                                <button id="salvar-cad" type="submit" class="btn btn-success">Entrar</button>
                                <a href="#signup" class="reset_pass"> Esqueceu sua senha ? </a>
                            </div>

                            <div id="divCarregando" class="progresso"></div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> <?php echo $delivery ?></h1>
                                    <p><?php echo $direitos ?></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="esqueceu_senha1" class="animate form registration_form">
                    <section class="login_content">
                        <form id="formulario_esqueceu_senha" action="esqueceu_senha.php" method="POST" enctype="multipart/form-data">
                            <h1> <?php echo $titulo_esqueceu_senha ?> </h1>
                            <div>
                                <input type="email" id="email_esqueceu_senha"; class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <button id="btn-esqueceu-senha" type="submit" class="btn btn-success">Enviar Senha</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Voltar para Login ?
                                    <a href="#esqueceu_senha" class="to_register"> clique aqui </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> <?php echo $delivery ?></h1>
                                    <p><?php echo $direitos ?></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="vendors/iCheck/icheck.min.js"></script>

        <script>
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
            $(document).ready(function ($) {

                $("#formulario").submit(function (event) {
                    event.preventDefault();

                    $.ajax({
                        beforeSend: function () {
                            $('#divCarregando').fadeIn();
                        },
                        url: 'fazer_login.php',
                        data: {
                            user: $("#user").val(),
                            senha: $("#senha").val()
                        },
                        type: 'POST',
                        dataType: "html",
                        success: function (retorno) {
                            $('#divCarregando').fadeOut('slow');
                            //alert(retorno);
                            if (parseInt(retorno) === 0) {
                                msgError('Usuário/ Senha não encontrado, verifique e tente novamente!');
                            } else {
                                window.location.href = "index.php";
                            }
                        },
                        error: function (request, status, error) {
                            var err = eval("(" + request.responseText + ")");
                            $('#divCarregando').fadeOut('slow');
                        }
                    });
                    return false;
                });

                $("#formulario_esqueceu_senha").submit(function (event) {
                    event.preventDefault();

                    $.ajax({
                        beforeSend: function () {
                            $('#divCarregando').fadeIn();
                        },
                        url: 'esqueceu_senha.php',
                        data: {
                            email: $("#email_esqueceu_senha").val()
                        },
                        type: 'POST',
                        dataType: "html",
                        success: function (retorno) {
                            $('#divCarregando').fadeOut('slow');
                            //alert(retorno);
                            if (parseInt(retorno) === 0) {
                                msgError('Usuário não encontrado, verifique e tente novamente!');
                            } else {
                                msgSucess('E-mail enviado, verifique sua caixa de entrada!');
                            }
                        },
                        error: function (request, status, error) {
                            var err = eval("(" + request.responseText + ")");
                            $('#divCarregando').fadeOut('slow');
                        }
                    });
                    return false;
                });

            });
        </script>
    </body>

</html>