<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/empresaControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $ids = explode(",", substr($_POST['id'], 0, strlen($_POST['id']) - 1));

    foreach ($ids as $id) :
        $eControle = new EmpresaControle();
        $eControle->atualizarEmpresa(base64_decode($id));
    endforeach;
endif;
?>