<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/usuarioControle.php");
include ("../../modelo/usuarioModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $usuarioControle = new UsuarioControle();
    if (empty($_POST['id'])):
        $email = $usuarioControle->validaEmail($_POST['email']);
    endif;
    if ($email == $_POST['email']) :
        echo 'errorEmail';
    else :

        $ativo = ($_POST['ativo'] == 'on' ? "S" : "N");
        $data = date("Y-m-d");
        $hora = date("H:i:s");
        $tipoCadastro = "web";
        $id_empresa = 1;

        // removendo os caracteres
        $caracter1 = array(".", "/", "-");
        $cpf = str_replace($caracter1, "", $_POST['cpf']);
        
        $caracter2 = array("(", ")", "-");
        $telefone = str_replace($caracter2, "", $_POST['telefone']);

        $usuarioModelo = new UsuarioModelo();
        $usuarioModelo->setId((int) $_POST['id']);
        $usuarioModelo->setNome($_POST['nome']);
        $usuarioModelo->setCpf($cpf);
        $usuarioModelo->setTelefone($telefone);
        $usuarioModelo->setEmail($_POST['email']);
        $usuarioModelo->setSenha($_POST['senha']);
        $usuarioModelo->setAtivo($ativo);
        $usuarioModelo->setDataCadastro($data);
        $usuarioModelo->setHoraCadastro($hora);
        $usuarioModelo->setTipoCadastro($tipoCadastro);
        $usuarioModelo->setDataAlteracao($data);
        $usuarioModelo->setHoraAlteracao($hora);
        $usuarioModelo->setTipoAlteracao($tipoCadastro);
        $usuarioModelo->setEmpresa((int) $id_empresa);
        //$usuarioModelo->setModulo($_POST['modulo']);

        $usuarioControl = new UsuarioControle();
        $id = $usuarioControl->inserirUsuario($usuarioModelo);

        if ((int) $_POST['id'] == $id) {
            echo 'trueAlterar';
        } else if ($id > 0) {
            echo 'trueSalvar';
        } else {
            echo 'errorCadastrar';
        }
    endif;
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>