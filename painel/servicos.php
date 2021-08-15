<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new ServicoControle();
$obj = json_decode($sql->buscarTodosServico($_SESSION["ID_EMPRESA"]));
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
                    <input type="hidden" value="cad_servico" id="area" />  
                    <input type="hidden" value="servico" id="caminho" />
                    <div class="clearfix"></div>
                </div>                
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                ?>
                                <tr class="<?= base64_encode($registro->id) ?>">
                                    <td><?= utf8_decode($registro->descricao) ?></td>
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
