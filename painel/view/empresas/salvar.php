<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/empresaControle.php");
include ("../../modelo/empresaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $situacao = ($_POST['status'] == 'on' ? 1 : 0);
    $status = ($_POST['empresa_aberta'] == 'on' ? "S" : "N");

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $ingressoModelo = new EmpresaModelo();
    $ingressoModelo->setId((int) $_POST['id']);
    $ingressoModelo->setNome($_POST['nome_empresa']);
    $ingressoModelo->setApelido($_POST['apelido']);
    $ingressoModelo->setTelefone($_POST['telefone_principal']);
    $ingressoModelo->setCidade($_POST['cidade']);
    $ingressoModelo->setEstado($_POST['estado']);
    $ingressoModelo->setEmpresa_aberta($status);
    $ingressoModelo->setMensagem_usuario_01($_POST['mensagem_usuario_01']);
    $ingressoModelo->setMensagem_usuario_02($_POST['mensagem_usuario_02']);
    $ingressoModelo->setStatus((int) $situacao);
    $ingressoModelo->setDataCadastro($data);
    $ingressoModelo->setHoraCadastro($hora);
    $ingressoModelo->setTipoCadastro($tipoCadastro);
    $ingressoModelo->setDataAlteracao($data);
    $ingressoModelo->setHoraAlteracao($hora);
    $ingressoModelo->setTipoAlteracao($tipoCadastro);

    $empresaControle = new EmpresaControle();
    $id = $empresaControle->salvarEmpresa($ingressoModelo);

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