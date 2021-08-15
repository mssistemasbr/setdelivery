<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/localEntregaControle.php");
include ("../../modelo/localEntregaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $areaModelo = new LocalEntregaModelo();
    $areaModelo->setId((int) $_POST['id']);
    $areaModelo->setDescricao($_POST['descricao']);
    $areaModelo->setAtivo($ativo);
    $areaModelo->setDataCadastro($data);
    $areaModelo->setHoraCadastro($hora);
    $areaModelo->setTipoCadastro($tipoCadastro);
    $areaModelo->setDataAlteracao($data);
    $areaModelo->setHoraAlteracao($hora);
    $areaModelo->setTipoAlteracao($tipoCadastro);
    
    $areaControle = new LocalEntregaControle();
    $id = $areaControle->salvarLocalEntrega($areaModelo);

    if((int) $_POST['id'] == $id) {
        echo 'trueAlterar';
    } else if ($id > 0) {
        echo 'trueSalvar';
    } else {
        echo 'errorCadastrar';
    }
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>