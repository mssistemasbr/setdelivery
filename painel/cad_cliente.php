<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new ClienteControle();
    $obj = json_decode($sql->buscarClienteId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $nome_cliente = utf8_decode($registro->nome_cliente);
            $telefone_celular = utf8_decode($registro->telefone_celular);
            $email = utf8_decode($registro->email);
            $senha = utf8_decode($registro->senha);
            $ativo = utf8_decode($registro->ativo);
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
                        <input type = "hidden" id = "area" value="clientes" />
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "view/cliente/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <span class = "section">Cadastro de Clientes</span>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "nome_cliente">Nome <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id="nome_cliente" value="<?= $nome_cliente ?>" class = "form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nome_cliente" placeholder="Nome Cliente" required = "required" type = "text">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telefone_celular">Telefone Celular <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "tel" name = "telefone_celular" value="<?= $telefone_celular ?>" class = "form-control" required = "required" placeholder = "(99) 9 999-9999" data-inputmask = "'mask' : '(99) 9 9999-9999'">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "email">Email <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "email" name="email" value="<?= $email ?>" placeholder = "Email" class = "form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label for = "password" class = "control-label col-md-3">Senha* </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id = "password" type = "text" name = "senha" value="<?= $senha ?>" class = "form-control col-md-7 col-xs-12" required = "required" placeholder = "Senha">
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
                                    <button id="salvar-cad" type = "submit" class = "btn <?= $id == null ? 'btn-success' : 'btn-info' ?>"><?= $id == null ? 'Cadastrar' : 'Alterar' ?></button>
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
