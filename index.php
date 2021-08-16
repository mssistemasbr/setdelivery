<?php
$idCliente = 0;

include './painel/config/crud.php';
include './painel/controle/formaPagamentoControle.php';
include './painel/controle/localEntregaControle.php';
include './painel/controle/horarioFuncionamentoControle.php';
include './painel/controle/empresaControle.php';
include './painel/controle/tipoPizzaControle.php';
include './painel/controle/tipoProdutoControle.php';
include './painel/controle/tamanhoPizzaControle.php';
include './painel/controle/produtoControle.php';

// Forma de Pagamento
$formaPagamento = new FormaPagamentoControle();
$sqlForma = json_decode($formaPagamento->buscarTodosFormaPagamentoAtivos());

// Local de Entrega
$localEntrega = new LocalEntregaControle();
$sqlLocal = json_decode($localEntrega->buscarTodosLocalEntregaAtivos());

// Horário de Funcionamento
$horarioFuncionamento = new HorarioFuncionamentoControle();
$sqlHorario = json_decode($horarioFuncionamento->buscarTodosHorario());

$empresa = new EmpresaControle();
$sqlempresa = json_decode($empresa->buscarEmpresaId(1));
if (!empty($sqlempresa)) :
    foreach ($sqlempresa as $registro):
        $telefone_empresa = utf8_decode($registro->telefone_principal);
        $apelido_empresa = utf8_decode($registro->apelido);
    endforeach;
endif;

// tipo Pizza
$tipoProduto = new TipoProdutoControle();
$objTipoPizza = json_decode($tipoProduto->buscarTodosTipoProdutoCategoria("P"));

$sqlTamPizza = new TamanhoPizzaControle();
$objTamanhoPizza = json_decode($sqlTamPizza->buscarTodosTamanhoPizza());

$sqlProdutos = new ProdutoControle();
$objProdutos = json_decode($sqlProdutos->buscarProdutoCategoria("P"));

$sqlProdutoB = new ProdutoControle();
$objBorda = json_decode($sqlProdutoB->buscarProdutoCategoria("B"));

$sqlProdutoA = new ProdutoControle();
$objAcrescimo = json_decode($sqlProdutoA->buscarProdutoCategoria("A"));
?>

<!DOCTYPE html>

<html lang="pt">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Set Delivery - Faça seu pedido.</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav-smarth">
            <div class="container">
                <button class="navbar-toggler text-uppercase font-weight-bold text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i>
                    Smarth
                </button>               
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Meus Pedido</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Menu 1</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Menu 2</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Menu 3</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Menu 4</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Menu 5</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar fixed-top" id="mainNav-web">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img class="img-logo" src="assets/img/logo.png"/></a>
                <div class="text-center">
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#modalFormaPagamento" href="#"><i class="fas fa-times fa-credit-card"></i>&nbsp;&nbsp;Forma Pagamento</a>
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#modalLocalEntrega" href="#"><i class="fas fa-times fa-map-marker"></i>&nbsp;&nbsp;Local Entrega</a>
                    <a class="btn" data-bs-toggle="modal" data-bs-target="#modalHorarioFuncionamento" href="#"><i class="fas fa-times fa-clock"></i>&nbsp;&nbsp;Hor. Funcionamento</a>
                    <a class="btn btn-xl btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLogin" style="padding-left: 2.5rem;padding-right: 3rem" href="#">Entrar</a>
                    <a class="btn btn-xl btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalCadastrar" href="#">Cadastrar</a>
                </div>
            </div>
        </nav>
        <!-- Portfolio Section-->
        <section class="page-section mt-4" id="portfolio">
            <div class="container mt-5">
                <div class="alert alert-danger mt-4" style="display: none;" role="alert">
                    <i class="fas fa-times fa-clock-o"></i>&nbsp;&nbsp;&nbsp;
                    Estabelecimento fechado para entrega de pedidos agora. Começaremos as 17:30.
                </div>
                <div class="alert mt-4" role="alert">
                    <div class="row align-items-start">
                        <div class="col-2 col-sm-2 mt-2"><hr/></div>
                        <div class="col-8 col-sm-8 text-center">
                            <span style="font-size: 1.5rem;color: #E4012F;font-weight: bold;">COMEÇAR PEDIDO</span>
                            <button style="width: 50%;padding: 0.7rem 1rem 0.7rem 1rem;background: #1763A1" type="button" class="btn mt-0">FAZER PEDIDO</button>
                        </div>
                        <div class="col-2 col-sm-2 mt-2"><hr/></div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col" id="col-image">
                        <div class="card">
                            <div class="card-body" style="padding: 0;border: 0"><img src="assets/img/img-banner-pizza.png"/></div>
                        </div>
                    </div>
                    <div class="col" id="col-pedido">
                        <div class="card">
                            <div class="card-header" style="background: #F40F3E;">
                                <img src="assets/img/img-meu-pedido.png"/>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start" id="lista-pedido">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><img src="assets/img/guarana.png"/>Guarana Antartica 2L</div>
                                        </div>
                                        <span class="badge mt-3" style="width: 25%;padding: 0">
                                            <button class="btn btn-primary text-center" id="soma-itens-pedido">+</button>
                                            <input type="text" id="soma-itens-pedido" value="0" style="width: 37%" class="form-control text-center"/>
                                            <button class="btn btn-primary text-sm-left" id="soma-itens-pedido">-</button>          
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start" id="lista-pedido">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><img src="assets/img/guarana.png"/>Guarana Antartica 2L</div>
                                        </div>
                                        <span class="badge mt-3" style="width: 25%;padding: 0">
                                            <button class="btn btn-primary text-center" id="soma-itens-pedido">+</button>
                                            <input type="text" id="soma-itens-pedido" value="0" style="width: 37%" class="form-control text-center"/>
                                            <button class="btn btn-primary text-sm-left" id="soma-itens-pedido">-</button>          
                                        </span>
                                    </li>
                                </ol>
                            </div>
                            <div class="card-footer text-muted" style="font-size: 1.5rem;font-weight: bold">
                                VALOR TOTAL : R$<span id="valor-total">100,00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- INICIO TELA PEDIDO -------------------------------------------->
        <section class="page-section" id="portfolio">
            <div class="container mt-5" style="height:400px;width: 100%;">
                <div id="carouselExampleControls" style="height:100%;width: 100%;" class="carousel slide" data-interval="false" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card rounded-0 rounded-top border-bottom-0 w-100" style="height:400px;">
                                <div class="card-header">
                                    1 Escolha o tipo de Pizza.
                                </div>
                                <ul class="list-group list-group-flush">
                                    <ol class="list-group">
                                        <?php
                                        $i = 0;
                                        foreach ($objTipoPizza as $registro):
                                            $i++;
                                            ?>
                                            <li class="border-0 list-group-item d-flex justify-content-between align-items-start rounded-0 border-bottom" id="lista-pedido">
                                                <div class="me-auto w-100">
                                                    <div class="form-check p-2">
                                                        <input class="form-check-input mt-3 mx-2" type="radio" name="rdTipoPiza" id="flexRadioDefault<?= $i ?>" value="<?= $registro->id_tipo_produto ?>">  
                                                        <label class="form-check-label" for="flexRadioDefault<?= $i ?>">
                                                            <div class="fw-bold"><?= utf8_decode($registro->descricao) ?></div>
                                                            <?= utf8_decode($registro->subdescricao) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol> 
                                </ul>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card rounded-0 rounded-top border-bottom-0 w-100 overflow-auto" style="height:400px;">
                                <div class="card-header">
                                    2 Escolha o tamanho da Pizza.
                                </div>
                                <ul class="list-group list-group-flush">
                                    <ol class="list-group">
                                        <?php
                                        $i = 0;
                                        foreach ($objTamanhoPizza as $registro):
                                            $i++
                                            ?>
                                            <li class="border-0 list-group-item d-flex justify-content-between align-items-start rounded-0 border-bottom" id="lista-pedido">
                                                <div class="me-auto w-100">
                                                    <div class="form-check p-2">
                                                        <input class="form-check-input mt-3 mx-2" type="radio" name="rdTamanhoPizza" id="flexRadioT<?= $i ?>" value="<?= $registro->id_tamanho_pizza ?>">  
                                                        <label class="form-check-label" for="flexRadioT<?= $i ?>">
                                                            <div class="fw-bold"><?= utf8_decode($registro->descricao) ?></div>
                                                            <?= utf8_decode($registro->subdescricao) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol> 
                                </ul>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card rounded-0 rounded-top border-bottom-0 w-100 overflow-auto" style="height:400px;">
                                <div class="card-header">
                                    4 Escolha 1 sabor da sua preferência:
                                </div>
                                <ul class="list-group list-group-flush">
                                    <ol class="list-group">
                                        <?php
                                        $i = 0;
                                        foreach ($objProdutos as $registro):
                                            $i++;
                                            ?>
                                            <li class="border-0 list-group-item d-flex justify-content-between align-items-start rounded-0 border-bottom" id="lista-pedido">
                                                <div class="me-auto w-100">
                                                    <div class="form-check p-2">
                                                        <input class="form-check-input mt-3 mx-2" type="radio" name="rdProdutoPizza" id="flexRadioProduto<?= $i ?>" value="<?= $registro->id_produto ?>">  
                                                        <label class="form-check-label" for="flexRadioProduto<?= $i ?>">
                                                            <div class="fw-bold"><?= utf8_decode($registro->nome_produto) ?></div>
                                                            <?= utf8_decode($registro->subdescricao) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="badge bg-primary rounded-pill mt-4 me-4">R$<?= $registro->valor_produto ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol> 
                                </ul>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card rounded-0 rounded-top border-bottom-0 w-100 overflow-auto" style="height:400px;">
                                <div class="card-header">
                                    4 Escolha até 1 borda:
                                </div>
                                <ul class="list-group list-group-flush">
                                    <ol class="list-group">
                                        <?php
                                        $i = 0;
                                        foreach ($objBorda as $registro):
                                            $i++;
                                            ?>
                                            <li class="border-0 list-group-item d-flex justify-content-between align-items-start rounded-0 border-bottom" id="lista-pedido">
                                                <div class="me-auto w-100">
                                                    <div class="form-check p-2">
                                                        <input class="form-check-input mt-3 mx-2" type="radio" name="rdProdutoBorda" id="flexRadioProdutoBorda<?= $i ?>" value="<?= $registro->id_produto ?>">  
                                                        <label class="form-check-label" for="flexRadioProdutoBorda<?= $i ?>">
                                                            <div class="fw-bold"><?= utf8_decode($registro->nome_produto) ?></div>
                                                            <?= utf8_decode($registro->subdescricao) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="badge bg-primary rounded-pill mt-4 me-4">R$<?= $registro->valor_produto ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol> 
                                </ul>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card rounded-0 rounded-top border-bottom-0 w-100 overflow-auto" style="height:400px;">
                                <div class="card-header">
                                    4 Escolha até 1 borda:
                                </div>
                                <ul class="list-group list-group-flush">
                                    <ol class="list-group">
                                        <?php
                                        $i = 0;
                                        foreach ($objAcrescimo as $registro):
                                            $i++;
                                            ?>
                                            <li class="border-0 list-group-item d-flex justify-content-between align-items-start rounded-0 border-bottom" id="lista-pedido">
                                                <div class="me-auto w-100">
                                                    <div class="form-check p-2">
                                                        <input class="form-check-input mt-3 mx-2" type="radio" name="rdProdutoAcrescimo" id="flexRadioProdutoA<?= $i ?>" value="<?= $registro->id_produto ?>">  
                                                        <label class="form-check-label" for="flexRadioProdutoA<?= $i ?>">
                                                            <div class="fw-bold"><?= utf8_decode($registro->nome_produto) ?></div>
                                                            <?= utf8_decode($registro->subdescricao) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="badge bg-primary rounded-pill mt-4 me-4">R$<?= $registro->valor_produto ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol> 
                                </ul>
                            </div>
                        </div>

                    </div>
                    <button class="carousel-control-next" style="background: #1763A1;width: 50%;height: 10%;top: 100%" type="button">Avançar</button>
                    <button class="carousel-control-prev" style="background: #1763A1;width: 50%;height: 10%;top: 100%" type="button">Voltar</button>
                </div>
            </div>
        </section>
        <!-- FIM TELA PEDIDO -------------------------------------------->

        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            2215 John Daniel Drive
                            <br />
                            Clark, MO 65243
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About Freelancer</h4>
                        <p class="lead mb-0">
                            Freelance is a free to use, MIT licensed Bootstrap theme created by
                            <a href="http://startbootstrap.com">Start Bootstrap</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2021</small></div>
        </div>
        <!-- Portfolio Modals-->        

        <!-- modal cadastrar -------------------------------------------->
        <div class="modal fade" id="modalCadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastre-se</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "painel/view/cliente/salvar.php" method = "post" enctype = "multipart/form-data" autocomplete="off">

                            <input type="hidden" id="idCliente" value="<?= $idCliente ?>" name="idCliente">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-times fa-user"></i></span>
                                <input type="text" id="nome" class="form-control" placeholder="Nome"  name="nome" autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" name="email" autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile-alt"></i></span>
                                <input type="text" id="celular" class="form-control" placeholder="Celular" aria-label="Username" aria-describedby="basic-addon1" name="celular" autocomplete="off" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                <input type="password" id="senha" class="form-control" placeholder="Senha" aria-label="Username" aria-describedby="basic-addon1" name="senha" autocomplete="off">
                            </div>
                        </form>
                    </div>
                    <button  id="cadastrarCliente" style="width: 92%;margin: 0 2rem 1rem 1rem;padding: 0.7rem 1rem 0.7rem 1rem;" type="submit" class="btn btn-danger">Cadastrar</button>

                    <!--
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Cadastrar</button>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <!-- Fim Modal Cadastrar -->

        <!-- modal cadastrar -------------------------------------------->

        <!-- Modal -->
        <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Acessar minha conta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "painel/view/cliente/salvar.php" method = "post" enctype = "multipart/form-data" autocomplete="on">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-times fa-user"></i></span>
                                <input type="text" id="xte" name="xte" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-times fa-lock"></i></span>
                                <input type="text" class="form-control" placeholder="Senha" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </form>
                    </div>
                    <button style="width: 92%;margin: 0 2rem 1rem 1rem;padding: 0.7rem 1rem 0.7rem 1rem;" type="submit" class="btn btn-danger">Entrar</button>

                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <button style="width: 92%;margin: 0 2rem 1rem 1rem;padding: 0.7rem 1rem 0.7rem 1rem;" type="button" class="btn btn-primary">Cadastrar</button>
                    <button style="width: 92%;margin: 0 2rem 1rem 1rem;padding: 0.7rem 1rem 0.7rem 1rem;" type="button" class="btn btn-primary">Esqueci a senha</button>
                </div>
            </div>
        </div>
        <!-- Fim Modal Cadastrar -->

        <!-- Modal alert -->
        <div class="modal fade" id="modalAlertCadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header alert-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal Cadastrar -->

        <!-- Modal Forma Pagamento -->
        <div class="modal fade" id="modalFormaPagamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Forma de Pagamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <table class="table table-striped">
                        <?php
                        foreach ($sqlForma as $registro):
                            ?>                            
                            <tr><td><?= utf8_decode($registro->descricao) ?></td></tr>
                        <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </div>
        <!-- Fim Modal Forma Pagamento -->

        <!-- Modal LocalEntrega -->
        <div class="modal fade" id="modalLocalEntrega" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Local de Entrega</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <table class="table table-striped">
                        <?php
                        foreach ($sqlLocal as $registro):
                            ?>                            
                            <tr><td><?= utf8_decode($registro->descricao) ?></td></tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fim Modal LocalEntrega -->

        <!-- Modal Horário de Funcionamento -->
        <div class="modal fade" id="modalHorarioFuncionamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 80%">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Horário de Funcionamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <table class="table table-striped">
                        <?php
                        foreach ($sqlHorario as $registro):
                            ?>                            
                            <tr><td><?= utf8_decode($registro->segunda) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->terca) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->quarta) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->quinta) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->sexta) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->sabado) ?></td></tr>
                            <tr><td><?= utf8_decode($registro->domingo) ?></td></tr>                            
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fim Modal Horário de Funcionamento -->


        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Section: Social media -->
            <section
                class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
                >
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Fale Conosco
                            </h6>
                            <p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp; Telefone: <?php echo $telefone_empresa ?> </p>
                            <p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp; setdelivery@gmail.com</p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->

                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-money-bill-wave-alt"></i> Forma de Pagamento
                            </h6>
                            <?php
                            foreach ($sqlForma as $registro):
                                ?>                            
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->descricao) ?></p></td></tr>
                            <?php endforeach; ?>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-pizza-slice"></i> <?php echo $apelido_empresa ?>
                            </h6>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormaPagamento" class="text-reset"><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;Forma de pagamento</a></p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalLocalEntrega" class="text-reset"><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;Locais de entrega</a></p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalUsoePrivacidade" class="text-reset"><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;Termos de Uso e Privacidade</a></p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalSubirElevador" class="text-reset"><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;Subir de Elevador</a></p>

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="far fa-clock"></i> Funcionamento
                            </h6>
                            <?php
                            foreach ($sqlHorario as $registro):
                                ?>                            
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->segunda) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->terca) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->quarta) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->quinta) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->sexta) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->sabado) ?></p></td></tr>
                                <tr><td><p class="p-0 m-0"><i class="fas fa-times fa-chevron-right"></i>&nbsp;&nbsp;<?= utf8_decode($registro->domingo) ?></p></td></tr>

                            <?php endforeach; ?>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

        <!-- Bootstrap core JS-->
        <script src="./painel/vendors/jquery/dist/jquery.min.js"></script>
        <script src="js/funcoes.js"></script>
        <script src="js/validacoes.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>