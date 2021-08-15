<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new UsuarioControle();
    $obj = json_decode($sql->buscarUsuarioId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $nome = $registro->nome;
            $cpf = $registro->cpf;
            $telefone = $registro->telefone;
            $email = $registro->email;
            $senha = $registro->senha;
            $status = $registro->status;
            $modulo = $registro->modulo;
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
                        <input type = "hidden" id = "area" value = "usuarios" />
                        <span class = "section">Usuario</span>
                        <form class="form-horizontal form-label-left" id = "formulario" action = "view/usuario/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <input type="hidden" name="id_empresa" value="<?= $_SESSION["ID_EMPRESA"] ?>" />
                            <input type="hidden" name="id_usuario" value="<?= $_SESSION["ID_USUARIO"] ?>" />
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">Cpf <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="cpf" value="<?= $cpf ?>" type="text" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" placeholder= "999.999.999-99" required="required" data-inputmask="'mask': '999.999.999-99'">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nome" value="<?= $nome ?>" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telefone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="telefone" value="<?= $telefone ?>" placeholder= "99 99999-9999" required="required" data-inputmask="'mask': '99 99999-9999'" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">E-mail <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" value="<?= $email ?>" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tamanho">Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="senha" value="<?= $senha ?>" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="switch">
                                        <input type="checkbox" name="status" <?= ($status == 1 ? 'checked' : '') ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBairro">Estado</label>
                                <select class="form-control" name="modulo" id="modulo">
                                    <option value="<?= $modulo ?>"><?= ($modulo == '' ? 'Selecione' : $modulo) ?></option>
                                    <option value="meioambiente">Meio Ambiente</option>
                                    <option value="manutencao">Manutenção</option>
                                </select>
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
