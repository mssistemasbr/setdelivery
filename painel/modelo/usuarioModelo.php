<?php

class UsuarioModelo {

    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $senha;
    private $status;
    private $empresa;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getStatus() {
        return $this->status;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setId($id){
        $this->id = $id;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCpf($cpf){
        $this->cpf = $cpf;
    }

    function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setSenha($senha){
        $this->senha = $senha;
    }

    function setStatus($status){
        $this->status = $status;
    }

    function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

}

?>
