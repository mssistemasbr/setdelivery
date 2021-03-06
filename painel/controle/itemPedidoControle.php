<?php

class ItemPedidoControle extends Crud {

    private $itemPedidoModelo;

    public function salvarItemPedido(ItemPedidoModelo $itemPedidoModelo) {
        $this->itemPedidoModelo = $itemPedidoModelo;
        try {
            if ($this->itemPedidoModelo->getIdItem() == 0):
                $id = parent::inserir("item_pedido", "id_item,id_produto,id_tipo_pizza,id_tam_pizza,id_acrescimo,id_borda,qtde,obs,sessao",
                                $this->itemPedidoModelo->getIdItem() . "|" .
                                $this->itemPedidoModelo->getIdProduto() . "|" .
                                $this->itemPedidoModelo->getIdTipoPizza() . "|" .
                                $this->itemPedidoModelo->getIdTamPizza() . "|" .
                                $this->itemPedidoModelo->getIdAcresPizza() . "|" .
                                $this->itemPedidoModelo->getIdBordaPizza() . "|" .
                                $this->itemPedidoModelo->getQuantidade() . "|" .
                                $this->itemPedidoModelo->getObs() . "|" .
                                $this->itemPedidoModelo->getSessao());

            else:
                parent::atualizar("item_pedido", "id_pedido,qtde,",
                        $this->itemPedidoModelo->getIdPedido() . "|" .
                        $this->itemPedidoModelo->getQuantidade() . "|" .
                        $this->itemPedidoModelo->getIdItem(), "id_item = ?");
                $id = $this->itemPedidoModelo->getIdItem();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarItemPedidoSessao($sessao, $parametro) {
        try {
            $sql = parent::selecionarJoin("item_pedido i", "i.id_item,i.qtde,p.nome_produto AS nome_pizza, p.valor_produto AS valor_pizza, a.nome_produto AS acrescimo, COALESCE(a.valor_produto,0) AS valor_acrescimo, t.descricao AS tipo_pizza, b.nome_produto AS nome_borda, COALESCE(b.valor_produto,0) AS valor_borda", "
                INNER JOIN produto p ON ( i.id_produto = p.id_produto )
                INNER JOIN tipo_pizza t ON ( i.id_tipo_pizza = t.id_tipo_pizza )
                LEFT JOIN produto a ON ( i.id_acrescimo = a.id_produto )
                LEFT JOIN produto b ON ( i.id_borda = b.id_produto )
                WHERE i.sessao = '" . $sessao . "'" . ($parametro == 0 ? 'AND i.id_pedido = 0' : '' ));
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage

            ());
        }
    }

    public function deletarItemPedido($id) {
        try {
            parent::deletar("item_pedido ", "id_item = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>