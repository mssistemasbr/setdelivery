<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/itemPedidoControle.php");
include ("../../modelo/itemPedidoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $itemPedidoModelo = new ItemPedidoModelo();
    $itemPedidoModelo->setIdItem((int) $_POST['idItem']);
    $itemPedidoModelo->setIdPedido((int) $_POST['idPedido']);
    $itemPedidoModelo->setIdProduto((int) $_POST['idProduto']);
    $itemPedidoModelo->setIdTipoPizza((int) $_POST['idTipoPizza']);
    $itemPedidoModelo->setIdTamPizza((int) intval($_POST['idTamPizza']));
    $itemPedidoModelo->setIdAcresPizza((int) intval($_POST['idAcrescimoPizza']));
    $itemPedidoModelo->setIdBordaPizza((int) intval($_POST['idBordaPizza']));
    $itemPedidoModelo->setQuantidade($_POST['qtde']);
    $itemPedidoModelo->setSessao($_POST['sessao']);

    $itemPedidoControle = new ItemPedidoControle();
    $id = $itemPedidoControle->salvarItemPedido($itemPedidoModelo);

    if ($id > 0) {
        echo 'trueSalvar';
    } else {
        echo 'errorCadastrar';
    }
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>