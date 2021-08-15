<?php

class ClienteModelo {
    private $idCliente;
    private $nomeCliente;
    private $telefoneOutros;
    private $telefoneCelular;
    private $email;
    private $senha;
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function getNomeCliente() {
        return $this->nomeCliente;
    }

    function getTelefoneOutros() {
        return $this->telefoneOutros;
    }

    function getTelefoneCelular() {
        return $this->telefoneCelular;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setNomeCliente($nomeCliente) {
        $this->nomeCliente = $nomeCliente;
    }

    function setTelefoneOutros($telefoneOutros) {
        $this->telefoneOutros = $telefoneOutros;
    }

    function setTelefoneCelular($telefoneCelular) {
        $this->telefoneCelular = $telefoneCelular;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }


    

}

?>
