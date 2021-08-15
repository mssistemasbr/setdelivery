<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new ProdutoControle();
    $obj = json_decode($sql->buscarProdutoId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $titulo = utf8_decode($registro->nome_produto);
            $descricao = utf8_decode($registro->subdescricao);
            $valor = $registro->valor_produto;
            $foto = $registro->foto_produto;
            $status = $registro->ativo;
            $idCat = $registro->id_tipo_produto;

            $c = new TipoProdutoControle();
            $cc = json_decode($c->buscarTipoProdutoId($idCat));
            if (!empty($cc)) :
                foreach ($cc as $registrocc):
                    $categoria = utf8_decode($registrocc->descricao);
                endforeach;
            endif;
        endforeach;
    endif;
else:
    $id = 0;
endif;
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <input type = "hidden" id = "area" value = "produtos" />
                        <span class = "section">Cadastro de Produtos</span>
                        <form class="form-horizontal form-label-left" id = "formulario" action = "view/produtos/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <input type="hidden" name="id_cliente" value="<?= $_SESSION["ID_CLIENTE"] ?>" />
                            <div class="item form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                <img id='img-upload' src="<?= ($foto == '' ? '' : 'img/produto/' . $foto) ?>" width="100"> <input name="foto" type="file" id="imgInp">
                                            </span>
                                        </span>
                                        <input type="hidden" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Titulo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="titulo" value="<?= $titulo ?>" type="text" class="form-control col-md-7 col-xs-12" placeholder= "Titulo" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor">Valor <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="valor" value="<?= $valor ?>" onkeypress="$(this).mask('99,00')" placeholder="00,00" maxlength="6" required="required" data-mask="99.99" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputBairro">Categoria Produto <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="categoria" id="modulo">
                                        <option value="<?= $idCat ?>"><?= ($categoria == '' ? 'Selecione' : $categoria) ?></option>
                                        <?php
                                        $cp = new TipoProdutoControle();
                                        $objC = json_decode($cp->buscarTodosTipoProduto());
                                        if (!empty($objC)) :
                                            foreach ($objC as $registroC):
                                                ?>
                                                <option value="<?= $registroC->id_tipo_produto ?>"><?= $registroC->descricao ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tamanho">Descrição <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="descricao" class="form-control col-md-7 col-xs-12"><?= $descricao ?></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Ativo</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="switch">
                                        <input type="checkbox" name="ativo" <?= ($status == "S" ? 'checked' : '') ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class = "col-md-6 col-md-offset-5">
                                    <button id="voltar" type="button" class="btn btn-danger">Cancelar</button>
                                    <button id="salvar-cad" type = "submit" class = "btn <?= $id == null ? 'btn-success' : 'btn-info'?>"><?= $id == null ? 'Cadastrar' : 'Alterar' ?></button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->




