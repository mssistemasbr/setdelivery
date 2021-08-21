<?php

class ClienteModelo {

    private $idCliente;
    private $nomeCliente;
    private $telefoneOutros;
    private $telefoneCelular;
    private $email;
    private $senha;
    private $ativo;
    private $dataCadastro;
    private $horaCadastro;
    private $tipoCadastro;
    private $dataAlteracao;
    private $horaAlteracao;
    private $tipoAlteracao;

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

    function getAtivo() {
        return $this->ativo;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getHoraCadastro() {
        return $this->horaCadastro;
    }

    function getTipoCadastro() {
        return $this->tipoCadastro;
    }

    function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    function getHoraAlteracao() {
        return $this->horaAlteracao;
    }

    function getTipoAlteracao() {
        return $this->tipoAlteracao;
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

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setHoraCadastro($horaCadastro) {
        $this->horaCadastro = $horaCadastro;
    }

    function setTipoCadastro($tipoCadastro) {
        $this->tipoCadastro = $tipoCadastro;
    }

    function setDataAlteracao($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }

    function setHoraAlteracao($horaAlteracao) {
        $this->horaAlteracao = $horaAlteracao;
    }

    function setTipoAlteracao($tipoAlteracao) {
        $this->tipoAlteracao = $tipoAlteracao;
    }

}

?>
