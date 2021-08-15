<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new ServicoControle();
    $obj = json_decode($sql->buscarServicoId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $descricao = utf8_decode($registro->descricao);
        endforeach;
    endif;
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
                        <input type = "hidden" id = "area" value = "servicos" />
                        <span class = "section">Serviços</span>
                        <form class="form-horizontal form-label-left" id = "formulario" action = "view/servico/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <input type="hidden" name="id_empresa" value="<?= $_SESSION["ID_EMPRESA"] ?>" />
                            <input type="hidden" name="id_usuario" value="<?= $_SESSION["ID_USUARIO"] ?>" />
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descrição <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="descricao" value="<?= $descricao ?>" placeholder= "Descrição" required="required" type="text">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <button id="voltar" type="button" class="btn btn-primary">Cancelar</button>
                                    <button id="salvar-cad" type = "submit" class = "btn btn-success">Cadastrar</button>
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
