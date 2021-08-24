<?php

class PedidoControle extends Crud {

    private $pedidoModelo;

    public function salvarPedido(PedidoModelo $pedidoModelo) {
        $this->pedidoModelo = $pedidoModelo;
        try {
            if ($this->pedidoModelo->getIdPedido() == 0):
                $id = parent::inserir("pedido", "id_pedido,data_pedido,hora_pedido,id_cliente,status,total_pedido,taxa_entrega,obs_pedido,pedido_ja_pago",
                                $this->pedidoModelo->getIdPedido() . "|" .
                                $this->pedidoModelo->getDataPedido() . "|" .
                                $this->pedidoModelo->getHoraPedido() . "|" .
                                $this->pedidoModelo->getIdCliente() . "|" .
                                $this->pedidoModelo->getStatus() . "|" .
                                $this->pedidoModelo->getTotalPedido() . "|" .
                                $this->pedidoModelo->getTaxaEntrega() . "|" .
                                $this->pedidoModelo->getObsPedido() . "|" .
                                $this->pedidoModelo->getPedidoPago());
            else:
                parent::atualizar("pedido", "data_pedido,hora_pedido,id_cliente,status,total_pedido,taxa_entrega,obs_pedido,id_tipo_pizza,id_tamanho_pizza,previsao_entrega,data_cancelado,hora_cancelado,motivo_cancelado",
                        $this->pedidoModelo->getDataPedido() . "|" .
                        $this->pedidoModelo->getHoraPedido() . "|" .
                        $this->pedidoModelo->getIdCliente() . "|" .
                        $this->pedidoModelo->getStatus() . "|" .
                        $this->pedidoModelo->getTotalPedido() . "|" .
                        $this->pedidoModelo->getTaxaEntrega() . "|" .
                        $this->pedidoModelo->getObsPedido() . "|" .
                        $this->pedidoModelo->getPedidoPago() . "|" .
                        $this->pedidoModelo->getIdTipoPizza() . "|" .
                        $this->pedidoModelo->getIdTamPizza() . "|" .
                        $this->pedidoModelo->getPrevisaoEntrega() . "|" .
                        $this->pedidoModelo->getDataCancelado() . "|" .
                        $this->pedidoModelo->getHoraCancelado() . "|" .
                        $this->pedidoModelo->getMotivoCancelado() . "|" .
                        $this->pedidoModelo->getIdPedido(), "id_pedido = ?");
                $id = $this->pedidoModelo->getIdPedido();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTodosPedidos() {
        try {
            $sql = parent::selecionarJoin("pedido p", "p.id_pedido,c.nome_cliente,c.telefone_celular,p.taxa_entrega,p.total_pedido,p.status,p.data_pedido,p.hora_pedido", "inner join cliente c on (p.id_cliente = c.id_cliente)");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarPedidoId($id) {
        try {
            $sql = parent::selecionar("pedido", "id_pedido,data_pedido,hora_pedido,id_cliente,status,total_pedido,taxa_entrega,obs_pedido,previsao_entrega,data_cancelado,hora_cancelado,motivo_cancelado", "id_pedido = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function selectgraficoDashboard_Pedidos() {
        try {
            $sql = parent::selecionar("pedido p", "count(p.id_pedido) as qtde, p.data_pedido as dataPedido", "(p.data_pedido = CURRENT_DATE() or p.data_pedido = CURRENT_DATE()-1 or p.data_pedido = CURRENT_DATE()-2) group by p.data_pedido order by p.data_pedido desc");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>