<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/enderecoClienteControle.php");
include ("../../modelo/enderecoClienteModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");
    $idlocal = 1;

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $enderecoClienteModelo = new EnderecoClienteModelo();
    $enderecoClienteModelo->setIdEnderecoCliente((int) $_POST['idEndereco']);
    $enderecoClienteModelo->setDescricaoEndereco($_POST['descricao_endereco']);
    $enderecoClienteModelo->setCep($_POST['cep']);
    $enderecoClienteModelo->setEndereco($_POST['endereco']);
    $enderecoClienteModelo->setNumero($_POST['numero']);
    $enderecoClienteModelo->setBairro($_POST['bairro']);
    $enderecoClienteModelo->setCidade($_POST['cidade']);
    $enderecoClienteModelo->setComplemento($_POST['complemento']);
    $enderecoClienteModelo->setPontoReferencia($_POST['ponto_referencia']);
    $enderecoClienteModelo->setIdLocalEntrega($idlocal);
    $enderecoClienteModelo->setIdCliente((int) $_POST['idcliente']);
    $enderecoClienteModelo->setAtivo($ativo);

    $enderecoClienteControle = new EnderecoClienteControle();
    $idSeq = $enderecoClienteControle->inserirEnderecoCliente($enderecoClienteModelo);

    if ((int) $_POST['idEndereco'] == $idSeq) {
        echo 'trueAlterar';
    } else if ($idSeq > 0) {
        echo 'trueSalvar';
    } else {
        echo 'errorCadastrar';
    }
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
