<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/horarioFuncionamentoControle.php");
include ("../../modelo/horarioFuncionamentoModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $tipoCadastro = "web";

    $horarioModelo = new HorarioFuncionamentoModelo();
    $horarioModelo->setId((int) $_POST['id']);
    $horarioModelo->setSegunda($_POST['segunda']);
    $horarioModelo->setTerca($_POST['terca']);
    $horarioModelo->setQuarta($_POST['quarta']);
    $horarioModelo->setQuinta($_POST['quinta']);
    $horarioModelo->setSexta($_POST['sexta']);
    $horarioModelo->setSabado($_POST['sabado']);
    $horarioModelo->setDomingo($_POST['domingo']);
    $horarioModelo->setDataCadastro($data);
    $horarioModelo->setHoraCadastro($hora);
    $horarioModelo->setTipoCadastro($tipoCadastro);
    $horarioModelo->setDataAlteracao($data);
    $horarioModelo->setHoraAlteracao($hora);
    $horarioModelo->setTipoAlteracao($tipoCadastro);
    
    $horarioControle = new HorarioFuncionamentoControle();
    $id = $horarioControle->salvarHorario($horarioModelo);

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