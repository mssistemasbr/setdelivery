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
        $situacao = ($_POST['status'] == 'on' ? 1 : 0);
        $caracter = array(".", "/", "-");
        $cpf = str_replace($caracter, "", $_POST['cpf']);

        $usuarioModelo = new UsuarioModelo();
        $usuarioModelo->setId((int) $_POST['id']);
        $usuarioModelo->setNome($_POST['nome']);
        $usuarioModelo->setCpf($cpf);
        $usuarioModelo->setTelefone($_POST['telefone']);
        $usuarioModelo->setEmail($_POST['email']);
        $usuarioModelo->setSenha($_POST['senha']);
        $usuarioModelo->setStatus((int) $situacao);
        $usuarioModelo->setEmpresa((int) $_POST['id_empresa']);
        $usuarioModelo->setModulo($_POST['modulo']);

        $usuarioControl = new UsuarioControle();
        $id = $usuarioControl->inserirUsuario($usuarioModelo);

        if ($id > 0) {
            if (!empty($_SESSION["ID_USUARIO"])):
                $sql = new UsuarioControle();
                $obj = json_decode($sql->buscarUsuarioId($id));
                if (!empty($obj)) :
                    foreach ($obj as $registro):
                        $_SESSION["NOME_USUARIO"] = $registro->nome;
                    endforeach;
                endif;
            endif;
            echo 'trueSalvar';
        } else {
            echo 'errorCadastrar';
        }
    endif;
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>