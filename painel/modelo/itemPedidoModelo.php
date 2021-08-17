<?php

class ItemPedidoModelo {

    private $idItem;
    private $idPedido;
    private $idProduto;
    private $idTipoPizza;
    private $idTamPizza;
    private $quantidade;
    private $sessao;

    function getIdItem() {
        return $this->idItem;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getIdProduto() {
        return $this->idProduto;
    }

    function getIdTipoPizza() {
        return $this->idTipoPizza;
    }

    function getIdTamPizza() {
        return $this->idTamPizza;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getSessao() {
        return $this->sessao;
    }

    function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    function setIdTipoPizza($idTipoPizza) {
        $this->idTipoPizza = $idTipoPizza;
    }

    function setIdTamPizza($idTamPizza) {
        $this->idTamPizza = $idTamPizza;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setSessao($sessao) {
        $this->sessao = $sessao;
    }

}

?>
