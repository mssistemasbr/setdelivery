<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/formaPagamentoControle.php");
include ("../../modelo/formaPagamentoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $formaPagamento = new FormaPagamentoModelo();
    $formaPagamento->setId((int) $_POST['id']);
    $formaPagamento->setDescricao($_POST['descricao']);
    $formaPagamento->setAtivo($ativo);
    $formaPagamento->setDataCadastro($data);
    $formaPagamento->setHoraCadastro($hora);
    $formaPagamento->setTipoCadastro($tipoCadastro);
    $formaPagamento->setDataAlteracao($data);
    $formaPagamento->setHoraAlteracao($hora);
    $formaPagamento->setTipoAlteracao($tipoCadastro);
    
    $formaPagamentoControle = new FormaPagamentoControle();
    $id = $formaPagamentoControle->salvarFormaPagamento($formaPagamento);

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