<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include './util/mask.php';
include './config/crud.php';
include './controle/usuarioControle.php';
include './controle/empresaControle.php';
include './controle/enderecoControle.php';
include './controle/tipoProdutoControle.php';
include './controle/tipoPizzaControle.php';
include './controle/tamanhoPizzaControle.php';
include './controle/produtoControle.php';
include './controle/localEntregaControle.php';
include './controle/horarioFuncionamentoControle.php';
include './controle/formaPagamentoControle.php';
include './controle/pedidoControle.php';
include './controle/clienteControle.php';

$usuarioControle = new UsuarioControle();
if (!$usuarioControle->protegePagina()) :
    echo "<script> location.href='login.php';</script>";
else:
    unset($usuarioControle);
endif;

// Empresa
$empresa = new EmpresaControle();
$sqlempresa = json_decode($empresa->buscarTodasEmpresa());
if (!empty($sqlempresa)) :
    foreach ($sqlempresa as $registro):
        $telefone_empresa = utf8_decode($registro->telefone_principal);
        $apelido_empresa = utf8_decode($registro->apelido);
    endforeach;
endif;


// Count Total Produto
$produtoTotal = new ProdutoControle();
$sqlprodutoTotal = json_decode($produtoTotal->contadorProdutoTotal());
if (!empty($sqlprodutoTotal)) :
    foreach ($sqlprodutoTotal as $registro):
        $totalProduto = utf8_decode($registro->qtdeReg);
    endforeach;
endif;

// Count Total Produto Hoje
$produtoTotalHj = new ProdutoControle();
$sqlprodutoTotalHj = json_decode($produtoTotalHj->contadorProdutoTotalHoje());
if (!empty($sqlprodutoTotalHj)) :
    foreach ($sqlprodutoTotalHj as $registro):
        $totalProdutoHj = utf8_decode($registro->qtdeReg);
    endforeach;
endif;

// Count Total Usuários
$usuarioTotal = new UsuarioControle();
$sqlusuarioTotal = json_decode($usuarioTotal->contadorUsuarioTotal());
if (!empty($sqlusuarioTotal)) :
    foreach ($sqlusuarioTotal as $registro):
        $totalUsuario = utf8_decode($registro->qtdeReg);
    endforeach;
endif;

// Count Total Usuários de Hoje
$usuarioTotalHj = new UsuarioControle();
$sqlusuarioTotalHj = json_decode($usuarioTotalHj->contadorUsuarioTotalHoje());
if (!empty($sqlusuarioTotalHj)) :
    foreach ($sqlusuarioTotalHj as $registro):
        $totalUsuarioHj = utf8_decode($registro->qtdeReg);
    endforeach;
endif;


// Total de Pedidos Hoje.
$totalPedido = new PedidoControle();
$sqltotalPedido = json_decode($totalPedido->selectgraficoDashboard_Pedidos());

$i = 1;
$diaAtual = "";
$dia1Anterior = "";
$dia2Anterior = "";
$totalDia = 0;
$total1DiaAnterior = 0;
$total2DiasAnterior = 0;
if (!empty($sqltotalPedido)) :
    foreach ($sqltotalPedido as $registro):
        if ($i == 1) {
            $totalDia = utf8_decode($registro->qtde);
            $diaAtual = utf8_decode($registro->dataPedido);
            $diaAtual = implode('/', array_reverse(explode('-', $diaAtual)));
            $i++;
        } else if ($i == 2) {
            $total1DiaAnterior = utf8_decode($registro->qtde);
            $dia1Anterior = utf8_decode($registro->dataPedido);
            $dia1Anterior = implode('/', array_reverse(explode('-', $dia1Anterior)));
            $i++;
        } else if ($i == 3) {
            $total2DiasAnterior = utf8_decode($registro->qtde);
            $dia2Anterior = utf8_decode($registro->dataPedido);
            $dia2Anterior = implode('/', array_reverse(explode('-', $dia2Anterior)));
            $i++;
        }
    endforeach;
else:
    $data_atual = date("d-m-Y");
    $diaAtual = $data_atual;

    $data_1dia = date_create($data_atual);
    date_sub($data_1dia, date_interval_create_from_date_string("1 day"));
    $dia1Anterior = date_format($data_1dia, "d-m-Y");

    $data_2dia = date_create($data_atual);
    date_sub($data_2dia, date_interval_create_from_date_string("2 days"));
    $dia2Anterior = date_format($data_2dia, "d-m-Y");
endif;

// Ranking Produtos - 5 mais vendidos
$produtoRanking = new ProdutoControle();
$sqlprodutoRanking = json_decode($produtoRanking->selectgraficoDashboard_RankingProduto());
$j = 1;
$produto1 = "-";
$qtde1 = 0;
$produto2 = " -";
$qtde2 = 0;
$produto3 = "-";
$qtde3 = 0;
$produto4 = "-";
$qtde4 = 0;
$produto5 = "-";
$qtde5 = 0;
if (!empty($sqlprodutoRanking)) :
    foreach ($sqlprodutoRanking as $registro):
        if ($j == 1) {
            $qtde1 = utf8_decode($registro->qtde);
            $produto1 = utf8_decode($registro->nome_produto);
            $j++;
        } else if ($j == 2) {
            $qtde2 = utf8_decode($registro->qtde);
            $produto2 = utf8_decode($registro->nome_produto);
            $j++;
        } else if ($j == 3) {
            $qtde3 = utf8_decode($registro->qtde);
            $produto3 = utf8_decode($registro->nome_produto);
            $j++;
        } else if ($j == 4) {
            $qtde4 = utf8_decode($registro->qtde);
            $produto4 = utf8_decode($registro->nome_produto);
            $j++;
        } else if ($j == 5) {
            $qtde5 = utf8_decode($registro->qtde);
            $produto5 = utf8_decode($registro->nome_produto);
            $j++;
        }
    endforeach;
else:
    $produto1 = "-";
    $qtde1 = 0;
    $produto2 = " -";
    $qtde2 = 0;
    $produto3 = "-";
    $qtde3 = 0;
    $produto4 = "-";
    $qtde4 = 0;
    $produto5 = "-";
    $qtde5 = 0;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./production/images/favicon.ico" type="image/ico" />

        <title>Painel Administrativo - Set Delivery</title>

        <!-- Bootstrap -->
        <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="./vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="./vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="./vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- Switchery -->
        <link href="./vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="./vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="./vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="./vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Dropzone.js -->
        <link href="./vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="./vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="./vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="./vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="./build/css/custom.min.css" rel="stylesheet">              
        <!-- Custom Theme Checkboxes -->
        <link href="./css/checkboxe-toggle.css" rel="stylesheet">
        <!-- Custom Theme datetime -->

        <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

        <script src="Scripts/jquery-2.0.3.js" type="text/javascript"></script>
        <link href="css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
        <link href="css/css.css" rel="stylesheet" type="text/css" />

        <style>
            .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
            .toggle.ios .toggle-handle { border-radius: 20rem; }
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

            #msg-sucess,#msg-error,#btn-confirm,#btn-alterar,#btn-ver-enderecos {
                display: none;
            }

            .border-checklist{
                border: 2px #000 solid;
                text-align: center;
            }
            .border-checklist-top{
                border-top: 2px #000 solid;
                text-align: center;
            }
            .border-checklist-rigth{
                border-right: 2px #000 solid;
                text-align: center;
            }
            .border-checklist-bottom{
                border-bottom: 2px #000 solid;
                text-align: center;
            }
            .border-checklist-left{
                border-left: 2px #000 solid;
                text-align: center;
            }
        </style>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    </head>

    <body class="nav-md" onload="init_grafico_pizza_produtos(<?= $totalProduto ?>,<?= $totalProdutoHj ?>); init_grafico_pizza_usuarios(<?= $totalUsuario ?>,<?= $totalUsuarioHj ?>);  init_grafico_pizza_pedidos(<?= $totalPedidosHj ?>); inicia_grafico_barra('<?= $produto1 ?>', <?= $qtde1 ?>, '<?= $produto2 ?>', <?= $qtde2 ?>, '<?= $produto3 ?>', <?= $qtde3 ?>, '<?= $produto4 ?>', <?= $qtde4 ?>, '<?= $produto5 ?>', <?= $qtde5 ?>);">        
        <div class="container body">
            <div id = "msg-sucess" class = "alert alert-success" role = "alert" style = "text-align: center">
                <strong></strong>
            </div>
            <div id = "msg-error" class = "alert alert-danger" role = "alert" style = "text-align: center">
                <strong></strong>
            </div>
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo $apelido_empresa ?></span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="./production/images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bem Vindo,</span>
                                <h2><?= (!empty($_SESSION["NOME_EMPRESA"]) ? utf8_decode($_SESSION["NOME_EMPRESA"]) : utf8_decode($_SESSION["NOME_USUARIO"])) ?></h2>
                            </div>
                        </div>
                        <!--/menu profile quick info -->

                        <br />

                        <!--sidebar menu -->
                        <div id = "sidebar-menu" class = "main_menu_side hidden-print main_menu">
                            <div class = "menu_section">
                                <h3>Menus</h3>
                                <ul class = "nav side-menu">

                                    <li><a href = "?pg=dashboard"><i class = "fa fa-home"></i> Home </a></li>

                                    <li><a><i class = "fa fa-cog"></i> Configurações <span class = "fa fa-chevron-down"></span></a>
                                        <ul class = "nav child_menu">

                                        </ul>

                                    <li><a><i class = "fa fa-desktop"></i> Cadastros <span class = "fa fa-chevron-down"></span></a>
                                        <ul class = "nav child_menu">
                                            <?php if ($_SESSION["ID_USUARIO"] == 1): ?> 
                                                <li><a href = "?pg=empresas">Empresas</a></li>
                                                <?php
                                            endif;
                                            ?>
                                            <li><a href = "?pg=clientes">Clientes</a></li>
                                            <li><a href = "?pg=usuarios">Usuários</a></li>
                                            <li><a href = "?pg=forma_pagamento">Forma de Pagamento</a></li>
                                            <li><a href = "?pg=horario">Horário de Funcionamento</a></li>
                                            <li><a href = "?pg=local_entrega">Local de Entrega</a></li>
                                            <li><a href = "?pg=tipo_produto">Tipo de Produto</a></li> 
                                            <li><a href = "?pg=tipo_pizza">Tipo de Pizza</a></li> 
                                            <li><a href = "?pg=tamanho_pizza">Tamanho da Pizza</a></li> 
                                            <li><a href = "?pg=produtos">Produtos</a></li>
                                        </ul>
                                    </li>


                                    <li><a><i class = "fa fa-paper-plane"></i> Movimentações <span class = "fa fa-chevron-down"></span></a>
                                        <ul class = "nav child_menu">
                                            <li><a href = "?pg=pedidos">Pedidos</a></li>
                                        </ul>

                                </ul>
                            </div>

                        </div>
                        <!--/sidebar menu -->

                        <!--/menu footer buttons -->
                        <div class = "sidebar-footer hidden-small">
                            <a data-toggle = "tooltip" data-placement = "top" title = "Settings">
                                <span class = "glyphicon glyphicon-cog" aria-hidden = "true"></span>
                            </a>
                            <a data-toggle = "tooltip" data-placement = "top" title = "FullScreen">
                                <span class = "glyphicon glyphicon-fullscreen" aria-hidden = "true"></span>
                            </a>
                            <a data-toggle = "tooltip" data-placement = "top" title = "Lock">
                                <span class = "glyphicon glyphicon-eye-close" aria-hidden = "true"></span>
                            </a>
                            <a data-toggle = "tooltip" data-placement = "top" title = "Logout" href = "login.html">
                                <span class = "glyphicon glyphicon-off" aria-hidden = "true"></span>
                            </a>
                        </div>
                        <!--/menu footer buttons -->
                    </div>
                </div>

                <!--top navigation -->
                <div class = "top_nav">
                    <div class = "nav_menu">
                        <nav>
                            <div class = "nav toggle">
                                <a id = "menu_toggle"><i class = "fa fa-bars"> </i></a>
                            </div>

                            <ul class = "nav navbar-nav navbar-right">
                                <li class = "">
                                    <a href = "javascript:;" class = "user-profile dropdown-toggle" data-toggle = "dropdown" aria-expanded = "false">

                                        <img src = "./production/images/img.jpg" alt = ""><?= (!empty($_SESSION["NOME_EMPRESA"]) ? utf8_decode($_SESSION["NOME_EMPRESA"]) : utf8_decode($_SESSION["NOME_USUARIO"])) ?>
                                        <span class = " fa fa-angle-down"></span>
                                    </a>
                                    <ul class = "dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href = "javascript:;"> Profile</a></li>
                                        <li>
                                            <a href = "javascript:;">
                                                <span class = "badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href = "javascript:;">Help</a></li>
                                        <li><a href="#" onclick="logout();"><i class = "fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>      

                            </ul>
                        </nav>
                    </div>
                </div>
                <!--/top navigation -->

                <?php
                $pagina = $_GET['pg'];

                if ($pagina == '') {
                    include('dashboard.php');
                } else {
                    include($pagina . '.php');
                }
                ?>

                <div id="divCarregando" class="progresso"></div>      

                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Deseja excluir realmente este item ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="modal-btn-si">Sim</button>
                                <button type="button" class="btn btn-primary" id="modal-btn-no">Não</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal-alterar2">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Erro ! Favor selecionar apenas um item para alteração!</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para ver os endereços dos clientes -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-ver-enderecos">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Meus Endereços</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="modal-btn-si">Novo Endereço</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        © setDelivery - 2021 © | <a href="https://www.setdelivery.com.br">site :setDelivery.com.br</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="./vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="./vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="./vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="./vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="./vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="./vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="./vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="./vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="./vendors/Flot/jquery.flot.js"></script>
        <script src="./vendors/Flot/jquery.flot.pie.js"></script>
        <script src="./vendors/Flot/jquery.flot.time.js"></script>
        <script src="./vendors/Flot/jquery.flot.stack.js"></script>
        <script src="./vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="./vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="./vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="./vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="./vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="./vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="./vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="./vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="./vendors/moment/min/moment.min.js"></script>
        <script src="./vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrapdatetimepicker -->    
        <script src="./vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <!-- jquery.inputmask -->
        <script src="./vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <!-- Switchery -->
        <script src="./vendors/switchery/dist/switchery.min.js"></script>
        <!-- iCheck -->
        <script src="./vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="./vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="./vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="./vendors/google-code-prettify/src/prettify.js"></script>
        <!-- Datatables -->
        <script src="./vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="./vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="./vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="./vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="./vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="./vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="./vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="./vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="./vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="./vendors/jszip/dist/jszip.min.js"></script>
        <script src="./vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="./vendors/pdfmake/build/vfs_fonts.js"></script>
        <!-- FastClick -->
        <script src="./vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="./vendors/nprogress/nprogress.js"></script>
        <!-- Dropzone.js -->
        <script src="./vendors/dropzone/dist/min/dropzone.min.js"></script>
        <script src="./js/funcoes.js"></script>
        <<script src="./js/funcoesgraficos.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="./build/js/custom.min.js"></script>   
        <script src="./js/checkboxe-toggle.js"></script>
        <!-- JQuery -->
        <script src="js/bootstrap-datetimepicker.min.js"></script>

        <!-- Gráfico de barras -->
        <script src="./vendors/raphael/raphael.min.js"></script>
        <script src="./vendors/morris.js/morris.min.js"></script>



        <script src="Scripts/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="Scripts/jquery.iframe-transport.js" type="text/javascript"></script>
        <script src="Scripts/jquery.fileupload.js" type="text/javascript"></script>
        <script type="text/javascript">

                                            $(function () {
                                                $('#fileupload').fileupload({
                                                    dataType: 'json',
                                                    type: 'POST',
                                                    formData: {diretorio: $("#diretorio").val()},
                                                    always: function (e, data) {
                                                        setTimeout(function () {
                                                            window.location.reload();
                                                        }, 1000);
                                                    }
                                                });
                                            });
        </script>

    </body>
</html>
