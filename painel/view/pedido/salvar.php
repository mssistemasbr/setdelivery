<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/pedidoControle.php");
include ("../../modelo/pedidoModelo.php");
include ("../../controle/itemPedidoControle.php");
include ("../../modelo/itemPedidoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $idPedido = 0;
    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $timeStamp = date("Y-m-d H:i:s");

    $pedidoModelo = new PedidoModelo();
    $pedidoModelo->setIdPedido(intval($_POST['idPedido']));
    $pedidoModelo->setDataPedido($data);
    $pedidoModelo->setHoraPedido($hora);
    $pedidoModelo->setIdCliente(intval($_POST['idCliente']));
    $pedidoModelo->setStatus("PEDIDO ENVIADO");
    $pedidoModelo->setTotalPedido(doubleval($_POST['valorPedido']));
    $pedidoModelo->setTaxaEntrega(0);
    $pedidoModelo->setObsPedido(null);
    $pedidoModelo->setPedidoPago("N");
    $pedidoModelo->setIdTipoPizza(null);
    $pedidoModelo->setIdTamPizza(null);
    $pedidoModelo->setPrevisaoEntrega($timeStamp);
    $pedidoModelo->setDataCancelado(null);
    $pedidoModelo->setHoraCancelado(null);
    $pedidoModelo->setMotivoCancelado(null);

    $pedidoControle = new PedidoControle();
    $idPedido = $pedidoControle->salvarPedido($pedidoModelo);

    if ($idPedido > 0):
        $ip = new ItemPedidoControle();
        $obj = json_decode($ip->buscarItemPedidoSessao($_POST['sessao'], 0));

        $qtd = explode(",", substr($_POST['qtde'], 0, strlen($_POST['qtde']) - 1));
        if (count($obj) > 0):
            $i = 0;
            foreach ($obj as $item):
                $itemPedidoModelo = new ItemPedidoModelo();
                $itemPedidoModelo->setIdItem(intval($item->id_item));
                $itemPedidoModelo->setIdPedido(intval($idPedido));
                $itemPedidoModelo->setQuantidade(doubleval($qtd[$i]));

                $itemPedidoControle = new ItemPedidoControle();
                $itemPedidoControle->salvarItemPedido($itemPedidoModelo);

                $itemPedidoModelo = null;
                $itemPedidoControle = null;
                $i++;
            endforeach;
        endif;
    endif;

    if ($idPedido > 0) {
        echo 'trueSalvar';
    } else {
        echo 'errorCadastrar';
    }
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>