<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new PedidoControle();
$obj = json_decode($sql->buscarTodosPedidos());
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <button type="button" id="novo-cad" class="btn btn-success">Novo</button>
                    <button type="button" id="btn-alterar" class="btn btn-info">Alterar</button>
                    <button type="button" id="btn-confirm" class="btn btn-danger">Excluir</button>
                    <input type="hidden" value="cad_forma_pagamento" id="area" />   
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
                                <th>Status</th>
                                <th>Data Pedido</th>
                                <th>Hora Pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                ?>
                                <tr class="<?= base64_encode($registro->id_pedido) ?>">
                                    <td><?= utf8_decode($registro->id_pedido) ?></td>
                                    <td><?= utf8_decode($registro->nome_cliente) ?></td>
                                    <td><?= utf8_decode($registro->telefone_celular) ?></td>
                                    <td><?= utf8_decode($registro->taxa_entrega) ?></td>
                                    <td><?= utf8_decode($registro->total_pedido) ?></td>
                                    <td><?= utf8_decode($registro->status) ?></td>                         
                                    <td><?=  implode('/', array_reverse(explode('-', $registro->data_pedido)))?></td>                                    
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
