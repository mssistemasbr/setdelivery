<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/tipoPizzaControle.php");
include ("../../modelo/tipoPizzaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $tipoPizzaModelo = new TipoPizzaModelo();
    $tipoPizzaModelo->setId((int) $_POST['id']);
    $tipoPizzaModelo->setDescricao($_POST['descricao']);
    $tipoPizzaModelo->setSubDescricao($_POST['subdescricao']);
    $tipoPizzaModelo->setAtivo($ativo);
    $tipoPizzaModelo->setDataCadastro($data);
    $tipoPizzaModelo->setHoraCadastro($hora);
    $tipoPizzaModelo->setTipoCadastro($tipoCadastro);
    $tipoPizzaModelo->setDataAlteracao($data);
    $tipoPizzaModelo->setHoraAlteracao($hora);
    $tipoPizzaModelo->setTipoAlteracao($tipoCadastro);
    
    $tipoPizzaControle = new TipoPizzaControle();
    $id = $tipoPizzaControle->salvarTipoPizza($tipoPizzaModelo);

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