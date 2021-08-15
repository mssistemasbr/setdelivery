<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Painel Administrativo - Set Delivery</title>

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
        </style>
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form id="formulario" action = "fazer_login.php" method = "post" enctype = "multipart/form-data">
                            <h1>Formulario de Login</h1>
                            <div>
                                <input type="text" id="user" class="form-control" name="user" placeholder="E-mail" required="" />
                            </div>
                            <div>
                                <input type="password" id="senha" class="form-control" name="senha" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button id="salvar-cad" type = "submit" class = "btn btn-success">Logar</button>
                                <a class="reset_pass" href="#">Perdeu seu password?</a>
                            </div>

                            <div id="divCarregando" class="progresso"></div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">
                                    <a href="#signup" class="to_register"> Nova Conta </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Jargs Técnologia</h1>
                                    <p>©2018 All Rights Reserved. Jargs Técnologia!Termos de privacidade</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                            <h1>Create Account</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="index.html">Submit</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
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
            $(document).ready(function ($) {
                $("#formulario").submit(function (event) {
                    event.preventDefault();
                    
                    $.ajax({
                        beforeSend: function () {
                            $('#divCarregando').fadeIn();
                        },
                        url: 'fazer_login.php',
                        data: {user: $("#user").val(), senha: $("#senha").val()},
                        type: 'POST',
                        dataType: "html",
                        success: function (retorno) {
                            $('#divCarregando').fadeOut('slow');
                            //alert(retorno);
                            if (parseInt(retorno) === 0) {
                                alert('Senha ou usuario invalidos');
                            } else {
                                window.location.href = "index.php";
                            }
                        }, error: function (request, status, error) {
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

