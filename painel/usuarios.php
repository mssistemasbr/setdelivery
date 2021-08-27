<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new UsuarioControle();
$obj = json_decode($sql->buscarTodosUsuarios(1));
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
                    <input type="hidden" value="cad_usuario" id="area" />
                    <input type="hidden" value="usuarios" id="caminho" />
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
                            foreach ($obj as $registro):
                                ?>
                                <tr class="<?= base64_encode($registro->id) ?>">
                                    <td><?= utf8_decode($registro->nome) ?></td>
                                    <td><?= utf8_decode($registro->telefone) ?></td>
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

<!--/page content -->
