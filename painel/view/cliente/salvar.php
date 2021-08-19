<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';


include ("../../config/crud.php");
include ("../../controle/clienteControle.php");
include ("../../modelo/clienteModelo.php");
include ("../../modelos_email/constantes.php");
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

    if ($email == $_POST['email']):
        echo 'errorEmail';
    elseif ($telefone_celular == $_POST['telefone_celular']):
        echo 'erroTelefone';
    else:
        $clienteModelo = new ClienteModelo();
        $clienteModelo->setIdCliente((int) $_POST['id']);
        $clienteModelo->setNomeCliente($_POST['nome_cliente']);
        $clienteModelo->setEmail($_POST['email']);
        $clienteModelo->setTelefoneCelular($_POST['telefone_celular']);
        $clienteModelo->setSenha($_POST['senha']);

        $clienteControle = new ClienteControle();
        $idCliente = $clienteControle->salvarCliente($clienteModelo);

        if ((int) $_POST['id'] == $idCliente) {
            echo 'trueAlterar';
        } else if ($idCliente > 0) {
            echo 'trueSalvar';

            // enviar email de boas-vindas.
            $empresaControle = new EmpresaControle();

            enviarEmail();
        } else {
            echo 'errorCadastrar';
        }
    endif;
else:
    echo $_SERVER['REQUEST_METHOD'];
endif;

function enviarEmail() {



    $mensagem = file_get_contents('../../modelos_email/modelo_bemvindo_01.txt');


    // Inicia a classe PHPMailer
    $mail = new PHPMailer();
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Host = 'br62.hostgator.com.br'; // Endereço do servidor SMTP
    $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Username = 'suporte@setdelivery.com.br'; // Usuário do servidor SMTP
    $mail->Password = 'mudar@123'; // Senha do servidor SMTP         
    $mail->From = 'suporte@setdelivery.com.br'; // Seu e-mail
    $mail->FromName = "setDelivery ©"; // Seu nome
    //$mail->AddAddress('contato@verticalle.com.br', 'Verticalle Elevadores');
    $mail->AddAddress('mssistemasbr@gmail.com');
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    //$mail->SMTPDebug = 2;
    //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = 'Assunto Teste'; // Assunto da mensagem
    // if ($corpoEmail != "" || $corpoEmail != null) {
    $mail->Body = $mensagem;
    // }
    //$mail->AltBody = "Este é o corpo da mensagem de teste,";
    // Envia o e-mail
    $enviado = $mail->Send();

    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();
}

?>