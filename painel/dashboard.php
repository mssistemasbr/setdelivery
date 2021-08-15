<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<div class="right_col" role="main">

    <h3><span id="bemVindo"></span>  <?php echo $apelido_empresa ?>  </h3>
    <div class="">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">

                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th style="width:40%;">
                                    <p>Gráfico de Produtos</p>
                                </th>

                            </tr>
                            <tr>
                                <td>
                                    <canvas class="graficoPizza_Produtos" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                </td>

                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square green"></i>Total Produtos </p>
                                            </td>
                                            <td><?php echo $totalProduto; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>Produtos Hoje </p>
                                            </td>
                                            <td><?php echo $totalProdutoHj; ?></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">

                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th style="width:40%;">
                                    <p>Gráfico de Usuários</p>
                                </th>

                            </tr>
                            <tr>
                                <td>
                                    <canvas class="graficoPizza_Usuarios" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                </td>

                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square green"></i>Total Usuários </p>
                                            </td>
                                            <td><?php echo $totalUsuario; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>Usuários Hoje </p>
                                            </td>
                                            <td><?php echo $totalUsuarioHj; ?></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">

                    <div class="x_content">

                          <table class="" style="width:100%">
                            <tr>
                                <th style="width:40%;">
                                    <p>Gráfico de Pedidos</p>
                                </th>
                            </tr>
                          </table>
                        
                        <div class="col-xs-12 bg-white progress_summary">

                            <div class="row">
                                <div class="progress_title">
                                    <span class="left"> <?php echo $diaAtual ?> </span>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="progress progress_sm"> 
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal= "<?php echo $totalDia ?>"></div>
                                    </div>
                                </div>
                                <div class="col-xs-2 more_info">
                                    <span> <?php echo $totalDia ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="progress_title">
                                    <span class="left"> <?php echo $dia1Anterior ?> </span>
                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $total1DiaAnterior ?>"></div>
                                    </div>
                                </div>
                                <div class="col-xs-2 more_info">
                                    <span> <?php echo $total1DiaAnterior ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="progress_title">
                                    <span class="left"> <?php echo $dia2Anterior ?> </span>
       
                                    <div class="clearfix"></div>
                                </div>            
                                <div class="col-xs-9">
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $total2DiasAnterior ?>"  ></div>
                                    </div>
                                </div>
                                <div class="col-xs-2 more_info">
                                    <span> <?php echo $total2DiasAnterior ?></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">

                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th style="width:40%;">
                                    <p>Gráfico de Ranking Produtos</p>
                                </th>

                            </tr>
                            <tr>
                                <td>
                                    <div id="graficoBarra_RankingProdutos"> </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

