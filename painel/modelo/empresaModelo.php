<?php

class EmpresaModelo {

    private $id;
    private $nome;
    private $apelido;
    private $telefone;
    private $cidade;
    private $estado;
    private $empresa_aberta;
    private $mensagem_usuario_01;
    private $mensagem_usuario_02;
    private $status;
    private $tipoCadastro;
    private $dataCadastro;
    private $horaCadastro;
    private $tipoAlteracao;
    private $dataAlteracao;
    private $horaAlteracao;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getEmpresa_aberta() {
        return $this->empresa_aberta;
    }

    function getMensagem_usuario_01() {
        return $this->mensagem_usuario_01;
    }

    function getMensagem_usuario_02() {
        return $this->mensagem_usuario_02;
    }

    function getStatus() {
        return $this->status;
    }

    function getTipoCadastro() {
        return $this->tipoCadastro;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getHoraCadastro() {
        return $this->horaCadastro;
    }

    function getTipoAlteracao() {
        return $this->tipoAlteracao;
    }

    function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    function getHoraAlteracao() {
        return $this->horaAlteracao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setEmpresa_aberta($empresa_aberta) {
        $this->empresa_aberta = $empresa_aberta;
    }

    function setMensagem_usuario_01($mensagem_usuario_01) {
        $this->mensagem_usuario_01 = $mensagem_usuario_01;
    }

    function setMensagem_usuario_02($mensagem_usuario_02) {
        $this->mensagem_usuario_02 = $mensagem_usuario_02;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTipoCadastro($tipoCadastro) {
        $this->tipoCadastro = $tipoCadastro;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setHoraCadastro($horaCadastro) {
        $this->horaCadastro = $horaCadastro;
    }

    function setTipoAlteracao($tipoAlteracao) {
        $this->tipoAlteracao = $tipoAlteracao;
    }

    function setDataAlteracao($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }

    function setHoraAlteracao($horaAlteracao) {
        $this->horaAlteracao = $horaAlteracao;
    }

}

?>
