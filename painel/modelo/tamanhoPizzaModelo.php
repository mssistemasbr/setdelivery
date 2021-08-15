<?php

class TamanhoPizzaModelo {

    private $id;
    private $descricao;
    private $subdescricao;
    private $ativo;
    private $dataCadastro;
    private $horaCadastro;
    private $tipoCadastro;
    private $dataAlteracao;
    private $horaAlteracao;
    private $tipoAlteracao;

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getSubDescricao() {
        return $this->subdescricao;
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

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setSubDescricao($subdescricao) {
        $this->subdescricao = $subdescricao;
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
