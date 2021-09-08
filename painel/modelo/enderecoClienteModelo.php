<?php

class EnderecoClienteModelo {

    private $idEnderecoCliente;
    private $descricaoEndereco;
    private $cep;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $complemento;
    private $pontoReferencia;
    private $idLocalEntrega;
    private $idCliente;
    private $ativo;
    
    function getIdEnderecoCliente() {
        return $this->idEnderecoCliente;
    }

    function getDescricaoEndereco() {
        return $this->descricaoEndereco;
    }

    function getCep() {
        return $this->cep;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getPontoReferencia() {
        return $this->pontoReferencia;
    }

    function getIdLocalEntrega() {
        return $this->idLocalEntrega;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setIdEnderecoCliente($idEnderecoCliente) {
        $this->idEnderecoCliente = $idEnderecoCliente;
    }

    function setDescricaoEndereco($descricaoEndereco) {
        $this->descricaoEndereco = $descricaoEndereco;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setPontoReferencia($pontoReferencia) {
        $this->pontoReferencia = $pontoReferencia;
    }

    function setIdLocalEntrega($idLocalEntrega) {
        $this->idLocalEntrega = $idLocalEntrega;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }



}

?>
