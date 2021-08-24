<?php

class PedidoModelo {

    private $idPedido;
    private $dataPedido;
    private $horaPedido;
    private $idCliente;
    private $status;
    private $totalPedido;
    private $taxaEntrega;
    private $obsPedido;
    private $pedidoPago;
    private $idTipoPizza;
    private $idTamPizza;
    private $previsaoEntrega;
    private $dataCancelado;
    private $horaCancelado;
    private $motivoCancelado;

    function getIdPedido() {
        return $this->idPedido;
    }

    function getDataPedido() {
        return $this->dataPedido;
    }

    function getHoraPedido() {
        return $this->horaPedido;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getStatus() {
        return $this->status;
    }

    function getTotalPedido() {
        return $this->totalPedido;
    }

    function getTaxaEntrega() {
        return $this->taxaEntrega;
    }

    function getObsPedido() {
        return $this->obsPedido;
    }

    function getPedidoPago() {
        return $this->pedidoPago;
    }

    function getIdTipoPizza() {
        return $this->idTipoPizza;
    }

    function getIdTamPizza() {
        return $this->idTamPizza;
    }

    function getPrevisaoEntrega() {
        return $this->previsaoEntrega;
    }

    function getDataCancelado() {
        return $this->dataCancelado;
    }

    function getHoraCancelado() {
        return $this->horaCancelado;
    }

    function getMotivoCancelado() {
        return $this->motivoCancelado;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setDataPedido($dataPedido) {
        $this->dataPedido = $dataPedido;
    }

    function setHoraPedido($horaPedido) {
        $this->horaPedido = $horaPedido;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTotalPedido($totalPedido) {
        $this->totalPedido = $totalPedido;
    }

    function setTaxaEntrega($taxaEntrega) {
        $this->taxaEntrega = $taxaEntrega;
    }

    function setObsPedido($obsPedido) {
        $this->obsPedido = $obsPedido;
    }

    function setPedidoPago($pedidoPago) {
        $this->pedidoPago = $pedidoPago;
    }

    function setIdTipoPizza($idTipoPizza) {
        $this->idTipoPizza = $idTipoPizza;
    }

    function setIdTamPizza($idTamPizza) {
        $this->idTamPizza = $idTamPizza;
    }

    function setPrevisaoEntrega($previsaoEntrega) {
        $this->previsaoEntrega = $previsaoEntrega;
    }

    function setDataCancelado($dataCancelado) {
        $this->dataCancelado = $dataCancelado;
    }

    function setHoraCancelado($horaCancelado) {
        $this->horaCancelado = $horaCancelado;
    }

    function setMotivoCancelado($motivoCancelado) {
        $this->motivoCancelado = $motivoCancelado;
    }

}

?>
