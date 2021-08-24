<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/itemPedidoControle.php");
include ("../../modelo/itemPedidoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $itemPedidoModelo = new ItemPedidoModelo();
    $itemPedidoModelo->setIdItem(intval($_POST['idItem']));
    $itemPedidoModelo->setIdPedido(intval($_POST['idPedido']));
    $itemPedidoModelo->setIdProduto(intval($_POST['idProduto']));
    $itemPedidoModelo->setIdTipoPizza(intval($_POST['idTipoPizza']));
    $itemPedidoModelo->setIdTamPizza(intval($_POST['idTamPizza']));
    $itemPedidoModelo->setIdAcresPizza(intval($_POST['idAcrescimoPizza']));
    $itemPedidoModelo->setIdBordaPizza(intval($_POST['idBordaPizza']));
    $itemPedidoModelo->setQuantidade(doubleval($_POST['qtde']));
    $itemPedidoModelo->setObs($_POST['obs']);
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