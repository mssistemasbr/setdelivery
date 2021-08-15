<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/tipoProdutoControle.php");
include ("../../modelo/tipoProdutoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";
    
    $tipoProduto = new TipoProdutoModelo();
    $tipoProduto->setId((int) $_POST['id']);
    $tipoProduto->setDescricao($_POST['descricao']);
    $tipoProduto->setAtivo($ativo);
    $tipoProduto->setDataCadastro($data);
    $tipoProduto->setHoraCadastro($hora);
    $tipoProduto->setTipoCadastro($tipoCadastro);
    $tipoProduto->setDataAlteracao($data);
    $tipoProduto->setHoraAlteracao($hora);
    $tipoProduto->setTipoAlteracao($tipoCadastro);
    
    $tipoProdutoControle = new TipoProdutoControle();
    $id = $tipoProdutoControle->salvarTipoProduto($tipoProduto);

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