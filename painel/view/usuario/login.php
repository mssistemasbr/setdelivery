<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/usuarioControle.php");
include ("../../modelo/usuarioModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $usuarioModelo = new UsuarioModelo();
    $usuarioModelo->setEmail(utf8_decode($_POST['email']));
    $usuarioModelo->setSenha(utf8_decode($_POST['senha']));

    $usuarioContro = new UsuarioControle();
    $login = $usuarioContro->validaUsuario($usuarioModelo);
    if ($login != 0) {
        echo 'trueLogin';
    } else {
        echo 'errorLogin';
    }
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;
?>