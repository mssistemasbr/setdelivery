<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

require '../../vendor/autoload.php';

include ("../../config/crud.php");
include ("../../controle/clienteControle.php");
include ("../../modelo/clienteModelo.php");
include ("../../controle/empresaControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :


    if (!empty($_POST['email'])):
        $e = new ClienteControle();
        $email = $e->checkEmailCliente($_POST['email']);
    endif;

    if (!empty($_POST['telefone_celular'])):
        $t = new ClienteControle();
        $telefone_celular = $t->checkTelefoneCliente($_POST['telefone_celular']);
    endif;



    if ($email == $_POST['email'] && $_POST['id'] != 0):
        echo 'errorEmail';
    elseif ($telefone_celular == $_POST['telefone_celular']):
        echo 'erroTelefone';
    else:

        $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");

        $data = date("Y-m-d");
        $hora = date("H:i:s");
        $tipoCadastro = "web";

        $clienteModelo = new ClienteModelo();
        $clienteModelo->setIdCliente((int) $_POST['id']);
        $clienteModelo->setNomeCliente($_POST['nome_cliente']);
        $clienteModelo->setEmail($_POST['email']);
        $clienteModelo->setTelefoneCelular($_POST['telefone_celular']);
        $clienteModelo->setSenha($_POST['senha']);
        $clienteModelo->setAtivo($ativo);
        $clienteModelo->setDataCadastro($data);
        $clienteModelo->setHoraCadastro($hora);
        $clienteModelo->setTipoCadastro($tipoCadastro);
        $clienteModelo->setDataAlteracao($data);
        $clienteModelo->setHoraAlteracao($hora);
        $clienteModelo->setTipoAlteracao($tipoCadastro);

        $clienteControle = new ClienteControle();
        $idCliente = $clienteControle->salvarCliente($clienteModelo);

        if ((int) $_POST['id'] == $idCliente) {
            echo 'trueAlterar';
        } else if ($idCliente > 0) {
            echo 'trueSalvar';

            // enviar email de boas-vindas.
            $emailc = new ClienteControle();
            $emailc->enviarEmail($_POST['email'], 1);
        } else {
            echo 'errorCadastrar';
        }
    endif;
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;