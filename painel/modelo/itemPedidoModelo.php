<?php

class ItemPedidoModelo {

    private $idItem;
    private $idPedido;
    private $idProduto;
    private $idTipoPizza;
    private $idTamPizza;
    private $idAcresPizza;
    private $idBordaPizza;
    private $quantidade;
    private $obs;
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

    function getIdAcresPizza() {
        return $this->idAcresPizza;
    }

    function getIdBordaPizza() {
        return $this->idBordaPizza;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getObs() {
        return $this->obs;
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

    function setIdAcresPizza($idAcresPizza) {
        $this->idAcresPizza = $idAcresPizza;
    }

    function setIdBordaPizza($idBordaPizza) {
        $this->idBordaPizza = $idBordaPizza;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }

    function setSessao($sessao) {
        $this->sessao = $sessao;
    }

}

?>
