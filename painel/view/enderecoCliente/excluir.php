<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/enderecoClienteControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $ids = explode(",", substr($_POST['idcliente'], 0, strlen($_POST['idcliente']) - 1));

    foreach ($ids as $id) :
        $excEndereco = new EnderecoClienteControle();
        $excEndereco->atualizarEnderecoCliente_Inativo(base64_decode($id));
    endforeach;
endif;
?>