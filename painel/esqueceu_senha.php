<?php

session_start();
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);


require './vendor/autoload.php';

include ("config/crud.php");
include ("controle/usuarioControle.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $usuarioControle = new UsuarioControle();
    $retorno = json_decode($usuarioControle->buscarUsuarioEmail($_POST['email']));
    
    $_SESSION['esqueceu_senha_email'] = $_POST['email'];
    
    if (count($retorno) > 0):
        $emailc = new UsuarioControle();
        $emailc->enviarEmail($_POST['email'], 2);
        echo 1;
    else:
        echo 0;
    endif;

endif;
?>

