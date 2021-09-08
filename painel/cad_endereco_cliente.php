<?php
if (isset($_GET['idcliente'])) :
    $idcliente = base64_decode($_GET['idcliente']);
    $sql = new ClienteControle();
    $obj = json_decode($sql->buscarClienteId($idcliente));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $nome_cliente = utf8_decode($registro->nome_cliente);
        endforeach;
    endif;


    // buscando dados do endereço
    $idendereco = base64_decode($_GET['idendereco']);
    $sqlendereco = new EnderecoClienteControle();
    $objEndereco = json_decode($sqlendereco->buscarEnderecoClienteId($idendereco));
    if (!empty($objEndereco)):
        foreach ($objEndereco as $reg):
            $descricao_endereco = utf8_decode($reg->descricao_endereco);
            $cep = utf8_decode($reg->cep);
            $endereco = utf8_decode($reg->endereco);
            $numero = utf8_decode($reg->numero);
            $bairro = utf8_decode($reg->bairro);
            $cidade = utf8_decode($reg->cidade);
            $complemento = utf8_decode($reg->complemento);
            $ponto_referencia = utf8_decode($reg->ponto_referencia);
            $ativo = utf8_decode($reg->ativo);
        endforeach;
    endif;
 

 
else:
    $idcliente = 0;
    $idendereco = 0;
endif;
?>
<!--page content -->
<div class = "right_col" role = "main">
    <div class = "">
        <div class = "clearfix"></div>
        <div class = "row">
            <div class = "col-md-12 col-sm-12 col-xs-12">
                <div class = "x_panel">
                    <div class = "x_content">
                        <input type = "hidden" id = "area" value="clientes" />
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "view/enderecoCliente/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="idEndereco" value="<?= $idendereco ?>" />
                            <input type="hidden" name="idcliente" value="<?= $idcliente ?>" />
                            <span class = "section">Cadastro de Endereço - "<?= $nome_cliente ?>" </span>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "descricao_endereco">Descrição do Endereço <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id="descricao_endereco" value="<?= $descricao_endereco ?>" class = "form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="descricao_endereco" placeholder="ex: minha casa, meu trabalho..." required = "required" type = "text">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "cep">Cep <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "cep" id="cep" value="<?= $cep ?>" class = "form-control" required = "required" placeholder = "99.999-999" data-inputmask = "'mask' : '99.999-999'">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "endereco">Endereço <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "endereco" name="endereco" value="<?= $endereco ?>" placeholder = "digite seu endereço" class = "form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "numero">Número <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "numero" name="numero" value="<?= $numero ?>" placeholder = "digite nº do endereço" class = "form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "bairro">Bairro <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "bairro" name="bairro" value="<?= $bairro ?>" placeholder = "digite seu bairro" class = "form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "cidade">Cidade <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "cidade" name="cidade" value="<?= $cidade ?>" placeholder = "digite sua cidade" class = "form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "complemento">Complemento
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "complemento" name="complemento" value="<?= $complemento ?>" placeholder = "ex: apto, fundos, casa..." class = "form-control col-md-7 col-xs-12">
                                </div>
                            </div>            

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "ponto_referencia">Ponto Referência
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "ponto_referencia" name="ponto_referencia" value="<?= $ponto_referencia ?>" placeholder = "ex: frente em bar, esquina da sorveteria..." class = "form-control col-md-7 col-xs-12">
                                </div>
                            </div>     

                            <div class = "item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ativo">Ativo</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="switch">
                                        <input type="checkbox" name="ativo" <?= ($ativo == "S" ? 'checked' : '') ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class = "ln_solid"></div>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <button id="voltar" type="button" class="btn btn-danger">Cancelar</button>
                                    <button id="salvar-cad" type = "submit" class = "btn <?= $idendereco == null ? 'btn-success' : 'btn-info' ?>"><?= $idendereco == null ? 'Cadastrar' : 'Alterar' ?></button>
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
