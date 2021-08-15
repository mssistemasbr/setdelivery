<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new EmpresaControle();
    $obj = json_decode($sql->buscarEmpresaId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $nome_empresa = utf8_decode($registro->nome_empresa);
            $apelido = utf8_decode($registro->apelido);
            $telefone = $registro->telefone_principal;
            $cidade = utf8_decode($registro->cidade);
            $estado = utf8_decode($registro->estado);
            $empresa_aberta = utf8_decode($registro->empresa_aberta);
            $mensagem_usuario_01 = utf8_decode($registro->mensagem_usuario_01);
            $mensagem_usuario_02 = utf8_decode($registro->mensagem_usuario_02);
            $status = $registro->status;
        endforeach;
    endif;
else:
    $id = 0;
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
                        <input type = "hidden" id = "area" value="empresas" />
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "view/empresas/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <span class = "section">Empresa</span>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "name">Nome <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id="nome" value="<?= $nome_empresa ?>" class = "form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nome_empresa" placeholder="Nome Empresa" required = "required" type = "text">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "email">Apelido <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="apelido" value="<?= $apelido ?>" required="required" placeholder="Apelido" class= "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "website">Cidade <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "website" name="cidade" value="<?= $cidade ?>" placeholder = "Cidade" class = "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label for = "password" class = "control-label col-md-3">Estado</label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id = "password" type = "text" name = "estado" value="<?= $estado ?>" class = "form-control col-md-7 col-xs-12" required = "required" placeholder = "Estado">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Telefone <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "tel" name = "telefone_principal" value="<?= $telefone ?>" class = "form-control" required = "required" placeholder = "(99) 999-9999" data-inputmask = "'mask' : '(99) 9999-9999'">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Mensagem 1 <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "mensagem_usuario_01" value="<?= $mensagem_usuario_01 ?>" class = "form-control" required = "required" placeholder = "Digite sua mensagem">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Mensagem 2 <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "mensagem_usuario_02" value="<?= $mensagem_usuario_02 ?>" class = "form-control" required = "required" placeholder = "Digite sua mensagem">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SITUACAO">Aberta</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="switch">
                                        <input type="checkbox" name="empresa_aberta" <?= ($empresa_aberta == "S" ? 'checked' : '') ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SITUACAO">Ativa</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="switch">
                                        <input type="checkbox" name="status" <?= ($status == 1 ? 'checked' : '') ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class = "ln_solid"></div>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
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
<!--/page content -->
