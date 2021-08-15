<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/produtoControle.php");
include ("../../modelo/produtoModelo.php");
include ("../../util/imagem.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    if ($_FILES['foto'] != "") :
        $f = new ProdutoControle();
        $nomeImg = $f->salvarImg($_FILES['foto'], $_POST['id'], 1000, 675);
    endif;

    $status = ($_POST['ativo'] == 'on' ? "S" : "N");
    $valor = str_replace(",", ".", $_POST['valor']);

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $produtoModelo = new ProdutoModelo();
    $produtoModelo->setId((int) $_POST['id']);
    $produtoModelo->setNome($_POST['titulo']);
    $produtoModelo->setSubdescricao($_POST['descricao']);
    $produtoModelo->setValor($valor);
    $produtoModelo->setFoto($nomeImg);
    $produtoModelo->setAtivo($status);
    $produtoModelo->setIdTipoProduto((int) $_POST['categoria']);
    $produtoModelo->setDataCadastro($data);
    $produtoModelo->setHoraCadastro($hora);
    $produtoModelo->setTipoCadastro($tipoCadastro);
    $produtoModelo->setDataAlteracao($data);
    $produtoModelo->setHoraAlteracao($hora);
    $produtoModelo->setTipoAlteracao($tipoCadastro);

    $produtoControle = new ProdutoControle();
    $id = $produtoControle->salvarProduto($produtoModelo);

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