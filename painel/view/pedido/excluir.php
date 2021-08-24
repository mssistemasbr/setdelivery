<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/itemPedidoControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $item = new ItemPedidoControle();
    $e = $item->deletarItemPedido($_POST['id']);    
    echo $e;
endif;
?>