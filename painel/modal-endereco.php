<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php

include 'config/crud.php';
include 'controle/clienteControle.php';

$enderecoCliente = new ClienteControle();
$sqlendereco = json_decode($enderecoCliente->buscarEnderecoCliente(base64_decode($_POST['idEndereco'])));
?>

<!-- Modal para ver os endereços dos clientes -->
<div class="modal fade" id="modal-ver-enderecos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Meus Endereços</h4>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <!-- page content -->
                    <div role="main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-buttons-endereco" onclick="seleciona_endereco_cliente();" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Descrição Endereço</th>
                                                    <th>Cep</th>
                                                    <th>Endereço</th>
                                                    <th>Número</th>
                                                    <th>Bairro</th>
                                                    <th>Cidade</th>
                                                    <th>Complemento</th>
                                                    <th>Ponto Referência</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($sqlendereco as $registro) :
                                                ?>
                                                    <tr style="cursor: pointer;" class="<?= base64_encode($registro->id_endereco_cliente) ?>">
                                                        <td><?= utf8_decode($registro->descricao_endereco) ?></td>
                                                        <td><?= utf8_decode($registro->cep) ?></td>
                                                        <td><?= utf8_decode($registro->endereco) ?></td>
                                                        <td><?= utf8_decode($registro->numero) ?></td>
                                                        <td><?= utf8_decode($registro->bairro) ?></td>
                                                        <td><?= utf8_decode($registro->cidade) ?></td>
                                                        <td><?= utf8_decode($registro->complemento) ?></td>
                                                        <td><?= utf8_decode($registro->ponto_referencia) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="<?= $_POST['idEndereco'] ?>" id="idEndereco" />
                    <input type="hidden" value="cad_endereco_cliente" id="area-endereco" />
                    <button type="button" id="btn-confirm" class="btn btn-danger">Excluir</button>
                    <button onclick="alterar_endereco_cliente();" type="button" id="excluir-endereco" class="btn btn-primary">Alterar Endereço</button>
                    <button onclick="abrirEndereco();" type="button" id="novo-cad-endereco" class="btn btn-success">Novo Endereço</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-excluir-endereco">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal 2</h4>
            </div>
            <div class="container"></div>
            <div class="modal-body">Alguma coisa aqui dentro.
                <a data-toggle="modal" href="#myModal3" class="btn btn-primary">Abrir</a>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Fechar</a>
            </div>
        </div>
    </div>
</div>