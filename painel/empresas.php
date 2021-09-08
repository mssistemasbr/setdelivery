<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new EmpresaControle();
$obj = json_decode($sql->buscarTodasEmpresa());
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <?php if (count($obj) == 0): ?>
                        <button type="button" id="novo-cad" class="btn btn-success">Novo</button>
                    <?php endif; ?>
                    <button type="button" id="btn-alterar" class="btn btn-info">Alterar</button>
                    <button type="button" id="btn-confirm" class="btn btn-danger">Excluir</button>
                    <input type="hidden" value="cad_empresa" id="area" />   
                    <input type="hidden" value="empresas" id="caminho" />
                    <div class="clearfix"></div>
                </div>                
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                ?>
                                <tr style="cursor: pointer;" class="<?= base64_encode($registro->id_empresa) ?>">
                                    <td><?= utf8_decode($registro->nome_empresa) ?></td>
                                    <td><?= $registro->telefone_principal ?></td>
                                    <td><?= $registro->cidade ?></td>
                                    <td><?= ($registro->status ? 'Ativo' : 'Inativo') ?></td>
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
