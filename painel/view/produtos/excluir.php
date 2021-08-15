<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/produtoControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $ids = explode(",", substr($_POST['id'], 0, strlen($_POST['id']) - 1));

    foreach ($ids as $id) :
        $p = new ProdutoControle();
        $p->deletarFotoProduto(base64_decode($id));
        
        $e = new ProdutoControle();
        $e->deletarProduto(base64_decode($id));
    endforeach;
endif;
?>