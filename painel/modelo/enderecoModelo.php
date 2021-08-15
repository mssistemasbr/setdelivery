<?php

class EnderecoModelo {

    private $id;
    private $estado;
    private $cidade;
    private $cep;
    private $bairro;
    private $endereco;
    private $numero;
    private $cliente;

    function getId() {
        return $this->id;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getCep() {
        return $this->cep;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setEstado($estado): void {
        $this->estado = $estado;
    }

    function setCidade($cidade): void {
        $this->cidade = $cidade;
    }

    function setCep($cep): void {
        $this->cep = $cep;
    }

    function setBairro($bairro): void {
        $this->bairro = $bairro;
    }

    function setEndereco($endereco): void {
        $this->endereco = $endereco;
    }

    function setNumero($numero): void {
        $this->numero = $numero;
    }

    function setCliente($cliente): void {
        $this->cliente = $cliente;
    }

}

?>