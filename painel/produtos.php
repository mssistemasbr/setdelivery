<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$sql = new ProdutoControle();
$obj = json_decode($sql->buscarTodosProdutos());
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
                    <input type="hidden" value="cad_produto" id="area" />   
                    <input type="hidden" value="produtos" id="caminho" />
                    <div class="clearfix"></div>
                </div>                
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>valor</th>
                                <th>Tipo Produto</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                $tipo = new TipoProdutoControle();
                                $objP = json_decode($tipo->buscarTipoProdutoId($registro->id_tipo_produto));
                                foreach ($objP as $o):
                                    $desTipoProduto = $o->descricao;
                                endforeach;
                                ?>
                                <tr style="cursor: pointer;" class="<?= base64_encode($registro->id_produto) ?>">
                                    <td><?= utf8_decode($registro->nome_produto) ?></td>
                                    <td><?= $registro->valor_produto ?></td>
                                    <td><?= utf8_decode($desTipoProduto) ?></td>
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
