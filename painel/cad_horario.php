<?php
if (isset($_GET['id'])) :
    $id = base64_decode($_GET['id']);
    $sql = new HorarioFuncionamentoControle();
    $obj = json_decode($sql->buscarHorarioId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $segunda = utf8_decode($registro->segunda);
            $terca = utf8_decode($registro->terca);
            $quarta = utf8_decode($registro->quarta);
            $quinta = utf8_decode($registro->quinta);
            $sexta = utf8_decode($registro->sexta);
            $sabado = utf8_decode($registro->sabado);
            $domingo = utf8_decode($registro->domingo);
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
                        <input type = "hidden" id = "area" value="horario" />
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "view/horario/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <span class = "section">Horário de Funcionamento</span>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "name">Segunda <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id="segunda" value="<?= $segunda ?>" class = "form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="segunda" required = "required" type = "text">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "email">Terça <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="terca" value="<?= $terca ?>" required="required" class= "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "website">Quarta <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id = "website" name="quarta" value="<?= $quarta ?>" class = "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label for = "password" class = "control-label col-md-3">Quinta</label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id = "password" type = "text" name = "quinta" value="<?= $quinta ?>" class = "form-control col-md-7 col-xs-12" required = "required" >
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Sexta <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "sexta" value="<?= $sexta ?>" class = "form-control" required = "required" >
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Sabado <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "sabado" value="<?= $sabado ?>" class = "form-control" required = "required">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Domingo <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "domingo" value="<?= $domingo ?>" class = "form-control" required = "required">
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
