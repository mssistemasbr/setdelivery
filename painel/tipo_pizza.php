<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new TipoPizzaControle();
$obj = json_decode($sql->buscarTodosTipoPizza());
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
                    <input type="hidden" value="cad_tipo_pizza" id="area" />   
                    <input type="hidden" value="tipo_pizza" id="caminho" />
                    <div class="clearfix"></div>
                </div>                
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>SubDescrição</th>
                                <th>Ativo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                ?>
                                <tr class="<?= base64_encode($registro->id_tipo_pizza) ?>">
                                    <td><?= utf8_decode($registro->descricao) ?></td>
                                    <td><?= utf8_decode($registro->subdescricao) ?></td>
                                    <td><?= ($registro->ativo == "S" ? 'Ativo' : 'Inativo') ?></td>
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
