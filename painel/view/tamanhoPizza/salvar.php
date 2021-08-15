<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/tamanhoPizzaControle.php");
include ("../../modelo/tamanhoPizzaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $tamanhoPizza = new TamanhoPizzaModelo();
    $tamanhoPizza->setId((int) $_POST['id']);
    $tamanhoPizza->setDescricao($_POST['descricao']);
    $tamanhoPizza->setSubDescricao($_POST['subdescricao']);
    $tamanhoPizza->setAtivo($ativo);
    $tamanhoPizza->setDataCadastro($data);
    $tamanhoPizza->setHoraCadastro($hora);
    $tamanhoPizza->setTipoCadastro($tipoCadastro);
    $tamanhoPizza->setDataAlteracao($data);
    $tamanhoPizza->setHoraAlteracao($hora);
    $tamanhoPizza->setTipoAlteracao($tipoCadastro);

    $tamanhoPizzaControle = new TamanhoPizzaControle();
    $id = $tamanhoPizzaControle->salvarTamanhoPizza($tamanhoPizza);

    if ((int) $_POST['id'] == $id) {
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