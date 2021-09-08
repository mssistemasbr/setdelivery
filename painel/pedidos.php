<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new PedidoControle();
$obj = json_decode($sql->buscarTodosPedidos());



// 01 - PEDIDO ENVIADO -
// 02 - PEDIDO CONFIRMADO -
// 03 - PEDIDO SAIU PARA ENTREGA -
// 04 - PEDIDO CANCELADO -
// 05 - PEDIDO ENTREGUE -
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <button type="button" id="novo-cad" class="btn btn-success">Novo</button>
                    <button type="button" id="btn-opcoes-pedido" class="btn btn-danger">Opções</button>

                    <input type="hidden" value="cad_pedidos" id="area" />
                    <input type="hidden" value="formaPagamento" id="caminho" />
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Nome</th>
                                <th>Celular</th>
                                <th>Taxa</th>
                                <th>Valor</th>
                                <th class="text-center"><span>Status</span></th>
                                <th>Data Pedido</th>
                                <th>Hora Pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro) :
                                if ($registro->status == "PEDIDO ENVIADO") :
                                    $corLinha = '#AED6F1';  // azul
                                    $status_label = 'label label-primary';
                                    $nome_status = 'Pedido Enviado';
                                    $link_enviado = 'https://bootdey.com/img/Content/user_1.jpg';
                                elseif ($registro->status == "PEDIDO CONFIRMADO") :
                                    $corLinha = '#F9E79F';  // amarelo
                                    $status_label = 'label label-warning';
                                    $nome_status = 'Pedido Confirmado';
                                    $link_enviado = 'https://bootdey.com/img/Content/user_2.jpg';
                                elseif ($registro->status == "PEDIDO SAIU PARA ENTREGA") :
                                    $corLinha = '#D2B4DE';  // dark
                                    $status_label = 'label label-default';
                                    $nome_status = 'Pedido Saiu para Entrega';
                                    $link_enviado = 'https://bootdey.com/img/Content/user_3.jpg';
                                elseif ($registro->status == "PEDIDO CANCELADO") :
                                    $corLinha = '#F5B7B1';  // cancelado
                                    $status_label = 'label label-danger';
                                    $nome_status = 'Pedido Cancelado';
                                    $link_enviado = 'https://bootdey.com/img/Content/user_2.jpg';
                                elseif ($registro->status == "PEDIDO ENTREGUE") :
                                    $corLinha = '#ABEBC6 ';  // verde
                                    $status_label = 'label label-success';
                                    $nome_status = 'Pedido Entregue';
                                    $link_enviado = 'https://bootdey.com/img/Content/user_1.jpg';
                                endif;
                            ?>
                                <tr class="<?= base64_encode($registro->id_pedido) ?>" style="cursor: pointer;">
                                    <td><?= utf8_decode($registro->id_pedido) ?></td>
                                    <td><?= utf8_decode($registro->nome_cliente) ?></td>
                                    <td><?= utf8_decode($registro->telefone_celular) ?></td>
                                    <td><?= number_format($registro->taxa_entrega, 2, ",", "."); ?></td>
                                    <td><?= number_format($registro->total_pedido, 2, ",", "."); ?></td>
                                    <td class="text-center"> <span class="<?= $status_label ?>"><?= $nome_status ?></span> </td>
                                    <td><?= implode('/', array_reverse(explode('-', $registro->data_pedido))) ?></td>
                                    <td><?= utf8_decode($registro->hora_pedido) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/page content -->