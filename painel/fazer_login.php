<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("config/crud.php");
include ("controle/usuarioControle.php");
include ("modelo/usuarioModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $usuarioModelo = new UsuarioModelo();
    $usuarioModelo->setEmail(utf8_decode($_POST['user']));
    $usuarioModelo->setSenha(utf8_decode($_POST['senha']));

    $usuarioControle = new UsuarioControle();
    $retorno = $usuarioControle->validaUsuario($usuarioModelo);
    echo $retorno;
endif;
?>

