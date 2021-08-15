<?php

class HorarioFuncionamentoModelo {

    private $id;
    private $segunda;
    private $terca;
    private $quarta;
    private $quinta;
    private $sexta;
    private $sabado;
    private $domingo;
    private $dataCadastro;
    private $horaCadastro;
    private $dataAlteracao;
    private $horaAlteracao;
    private $tipoCadastro;
    private $tipoAlteracao;

    function getId() {
        return $this->id;
    }

    function getSegunda() {
        return $this->segunda;
    }

    function getTerca() {
        return $this->terca;
    }

    function getQuarta() {
        return $this->quarta;
    }

    function getQuinta() {
        return $this->quinta;
    }

    function getSexta() {
        return $this->sexta;
    }

    function getSabado() {
        return $this->sabado;
    }

    function getDomingo() {
        return $this->domingo;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getHoraCadastro() {
        return $this->horaCadastro;
    }

    function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    function getHoraAlteracao() {
        return $this->horaAlteracao;
    }

    function getTipoCadastro() {
        return $this->tipoCadastro;
    }

    function getTipoAlteracao() {
        return $this->tipoAlteracao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSegunda($segunda) {
        $this->segunda = $segunda;
    }

    function setTerca($terca) {
        $this->terca = $terca;
    }

    function setQuarta($quarta) {
        $this->quarta = $quarta;
    }

    function setQuinta($quinta) {
        $this->quinta = $quinta;
    }

    function setSexta($sexta) {
        $this->sexta = $sexta;
    }

    function setSabado($sabado) {
        $this->sabado = $sabado;
    }

    function setDomingo($domingo) {
        $this->domingo = $domingo;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setHoraCadastro($horaCadastro) {
        $this->horaCadastro = $horaCadastro;
    }

    function setDataAlteracao($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }

    function setHoraAlteracao($horaAlteracao) {
        $this->horaAlteracao = $horaAlteracao;
    }

    function setTipoCadastro($tipoCadastro) {
        $this->tipoCadastro = $tipoCadastro;
    }

    function setTipoAlteracao($tipoAlteracao) {
        $this->tipoAlteracao = $tipoAlteracao;
    }

}

?>
