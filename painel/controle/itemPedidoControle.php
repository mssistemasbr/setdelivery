<?php

class ItemPedidoControle extends Crud {

    private $itemPedidoModelo;

    public function salvarItemPedido(ItemPedidoModelo $itemPedidoModelo) {
        $this->itemPedidoModelo = $itemPedidoModelo;

        try {
            if ($this->itemPedidoModelo->getIdItem() == 0):
                $id = parent::inserir("item_pedido", "id_item,id_produto,id_tipo_pizza,id_tam_pizza,sessao",
                                $this->itemPedidoModelo->getIdItem() . "|" .
                                $this->itemPedidoModelo->getIdProduto() . "|" .
                                $this->itemPedidoModelo->getIdTipoPizza() . "|" .
                                $this->itemPedidoModelo->getIdTamPizza() . "|" .
                                $this->itemPedidoModelo->getSessao());

            else:
                parent::atualizar("item_pedido", "id_pedido,qtde,",
                        $this->itemPedidoModelo->getIdPedido() . "|" .
                        $this->itemPedidoModelo->getQuantidade() . "|" .
                        $this->itemPedidoModelo->getIdItem(), "id_item = ?");
                $id = $this->itemPedidoModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTipoPizzaId($id) {
        try {
            $sql = parent::selecionar("tipo_pizza", "id_tipo_pizza,descricao,subdescricao,ativo", "id_tipo_pizza = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosTipoPizza() {
        try {
            $sql = parent::selecionar("tipo_pizza", "id_tipo_pizza,descricao,subdescricao,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarTipoPizza($id) {
        try {
            parent::deletar("tipo_pizza", "id_tipo_produto = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>