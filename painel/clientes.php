<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new ClienteControle();
$obj = json_decode($sql->buscarTodosClientes());
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <button type="button" id="novo-cad" class="btn btn-success">Novo</button>
                    <button type="button" id="btn-alterar" class="btn btn-info">Alterar</button>
                    <button type="button" id="btn-ver-enderecos"  class="btn btn-danger">Ver Endereços</button>
                    <input type="hidden" value="cad_cliente" id="area" />
                    <input type="hidden" value="clientes" id="caminho" />
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Senha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro) :
                                ?>
                                <tr style="cursor: pointer;" class="<?= base64_encode($registro->id_cliente) ?>">
                                    <td><?= utf8_decode($registro->nome_cliente) ?></td>
                                    <td><?= utf8_decode($registro->telefone_celular) ?></td>
                                    <td><?= utf8_decode($registro->email) ?></td>
                                    <td><?= utf8_decode($registro->senha) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-endereco"></div>
<!--/page content -->