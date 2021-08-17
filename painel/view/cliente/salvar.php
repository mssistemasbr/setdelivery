<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/clienteControle.php");
include ("../../modelo/clienteModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $clienteModelo = new ClienteModelo();
    $clienteModelo->setIdCliente((int)$_POST['idCliente']);
    $clienteModelo->setNomeCliente($_POST['nome']);
    $clienteModelo->setEmail($_POST['email']);
    $clienteModelo->setTelefoneCelular($_POST['celular']);
    $clienteModelo->setSenha($_POST['senha']);

    $clienteControle = new ClienteControle();
    $idCliente = $clienteControle->salvarCliente($clienteModelo);

    if((int) $_POST['id'] == $idCliente) {
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