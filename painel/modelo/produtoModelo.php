<?php

class ProdutoModelo {

    private $id;
    private $nome;
    private $subdescricao;
    private $valor;
    private $foto;
    private $ativo;
    private $idTipoProduto;
    private $dataCadastro;
    private $horaCadastro;
    private $dataAlteracao;
    private $horaAlteracao;
    private $tipoCadastro;
    private $tipoAlteracao;
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSubdescricao() {
        return $this->subdescricao;
    }

    function getValor() {
        return $this->valor;
    }

    function getFoto() {
        return $this->foto;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function getIdTipoProduto() {
        return $this->idTipoProduto;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSubdescricao($subdescricao) {
        $this->subdescricao = $subdescricao;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setIdTipoProduto($idTipoProduto) {
        $this->idTipoProduto = $idTipoProduto;
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