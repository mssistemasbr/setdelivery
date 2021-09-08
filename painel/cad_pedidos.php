<?php
if (isset($_GET['idpedido'])) :
    $id = base64_decode($_GET['idpedido']);
    $sql = new ClienteControle();
    $obj = json_decode($sql->buscarClienteId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro) :
            $nome_cliente = utf8_decode($registro->nome_cliente);
            $telefone_celular = utf8_decode($registro->telefone_celular);
            $email = utf8_decode($registro->email);
            $senha = utf8_decode($registro->senha);
            $ativo = utf8_decode($registro->ativo);
        endforeach;
    endif;
else :
    $idpedido = 0;



endif;
?>
<!--page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <input type="hidden" id="area" value="clientes" />
                        <form class="form-horizontal form-label-left" id="formulario" action="view/cliente/salvar.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <span class="section">Cadastro de Novo Pedido</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo_pizza">Escolha o tipo de pizza<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="tipo_pizza" id="tipo_pizza">
                                        <option value="<?= $id_tipo_pizza ?>"><?= ($descricao_pizza == '' ? 'Selecione' : $descricao_pizza) ?></option>
                                        <?php
                                        $sql_tipo_pizza = new TipoPizzaControle();
                                        $obj_tipo_pizza = json_decode($sql_tipo_pizza->buscarTodosTipoPizza());
                                        if (!empty($obj_tipo_pizza)) :
                                            foreach ($obj_tipo_pizza as $reg_tipo_pizza) :
                                        ?>
                                                <option value="<?= $reg_tipo_pizza->id_tipo_pizza ?>"><?= $reg_tipo_pizza->descricao ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tamanho_pizza">Escolha tamanho da pizza<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="tamanho_pizza" id="tamanho_pizza">
                                        <option value="<?= $id_tamanho_pizza ?>"><?= ($tamanho_pizza == '' ? 'Selecione' : $tamanho_pizza) ?></option>
                                        <?php
                                        $sql_tamanho_pizza = new TamanhoPizzaControle();
                                        $obj_tamanho_pizza = json_decode($sql_tamanho_pizza->buscarTodosTamanhoPizza());
                                        if (!empty($obj_tipo_pizza)) :
                                            foreach ($obj_tamanho_pizza as $reg_tamanho_pizza) :
                                        ?>
                                                <option value="<?= $reg_tamanho_pizza->id_tamanho_pizza ?>"><?= $reg_tamanho_pizza->descricao ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sabor_pizza">Escolha o sabor da pizza<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="sabor_pizza" id="sabor_pizza">
                                        <option value="<?= $id_sabor_pizza ?>"><?= ($sabor_pizza == '' ? 'Selecione' : $sabor_pizza) ?></option>
                                        <?php
                                        $sql_sabor_pizza = new ProdutoControle();
                                        $obj_sabor_pizza = json_decode($sql_sabor_pizza->buscarProdutoCategoria('P'));
                                        if (!empty($obj_sabor_pizza)) :
                                            foreach ($obj_sabor_pizza as $reg_sabor_pizza) :
                                        ?>
                                                <option value="<?= $reg_sabor_pizza->id_produto ?>"><?= $reg_sabor_pizza->nome_produto ?> - R$ <?= $reg_sabor_pizza->valor_produto ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="borda_pizza">Escolha a borda da pizza</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="borda_pizza" id="borda_pizza">
                                        <option value="<?= $id_borda_pizza ?>"><?= ($borda_pizza == '' ? 'Selecione' : $borda_pizza) ?></option>
                                        <?php
                                        $sql_borda_pizza = new ProdutoControle();
                                        $obj_borda_pizza = json_decode($sql_borda_pizza->buscarProdutoCategoria('B'));
                                        if (!empty($obj_borda_pizza)) :
                                            foreach ($obj_borda_pizza as $reg_borda_pizza) :
                                        ?>
                                                <option value="<?= $reg_borda_pizza->id_produto ?>"><?= $reg_borda_pizza->nome_produto ?> - R$ <?= $reg_borda_pizza->valor_produto ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="acrescimo_pizza">Escolha o acréscimo da pizza</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="acrescimo_pizza" id="acrescimo_pizza">
                                        <option value="<?= $id_acrescimo_pizza ?>"><?= ($acrescimo_pizza == '' ? 'Selecione' : $acrescimo_pizza) ?></option>
                                        <?php
                                        $sql_acrescimo_pizza = new ProdutoControle();
                                        $obj_acrescimo_pizza = json_decode($sql_acrescimo_pizza->buscarProdutoCategoria('A'));
                                        if (!empty($obj_acrescimo_pizza)) :
                                            foreach ($obj_acrescimo_pizza as $reg_acrescimo_pizza) :
                                        ?>
                                                <option value="<?= $reg_acrescimo_pizza->id_produto ?>"><?= $reg_acrescimo_pizza->nome_produto ?> - R$ <?= $reg_acrescimo_pizza->valor_produto ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Observações</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                </div>
                            </div>





                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="voltar" type="button" class="btn btn-danger">Cancelar</button>
                                    <button id="salvar-cad" type="submit" class="btn <?= $id == null ? 'btn-success' : 'btn-info' ?>"><?= $id == null ? 'Cadastrar' : 'Alterar' ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/page content -->