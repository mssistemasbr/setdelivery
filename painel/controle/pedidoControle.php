<?php

class PedidoControle extends Crud {

    private $pedidoModelo;

    public function salvarPedido(PedidoModelo $pedidoModelo) {
        $this->pedidoModelo = $pedidoModelo;
        
        /*
        try {
            if ($this->pedidoModelo->getId() == 0):
                $id = parent::inserir("pedido", "id_empresa,nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status,tipo_cadastro,data_cadastro,hora_cadastro",
                                $this->pedidoModelo->getId() . "|" .
                                $this->pedidoModelo->getNome() . "|" .
                                $this->pedidoModelo->getApelido() . "|" .
                                $this->pedidoModelo->getTelefone() . "|" .
                                $this->pedidoModelo->getCidade() . "|" .
                                $this->pedidoModelo->getEstado() . "|" .
                                $this->pedidoModelo->getEmpresa_aberta() . "|" .
                                $this->pedidoModelo->getMensagem_usuario_01() . "|" .
                                $this->pedidoModelo->getMensagem_usuario_02() . "|" .
                                $this->pedidoModelo->getStatus() . "|" .
                                $this->pedidoModelo->getTipoCadastro() . "|" .
                                $this->pedidoModelo->getDataCadastro() . "|" .
                                $this->pedidoModelo->getHoraCadastro());
            else:
                parent::atualizar("pedido", "nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status,tipo_alteracao,data_alteracao,hora_alteracao,",
                        $this->pedidoModelo->getNome() . "|" .
                        $this->pedidoModelo->getApelido() . "|" .
                        $this->pedidoModelo->getTelefone() . "|" .
                        $this->pedidoModelo->getCidade() . "|" .
                        $this->pedidoModelo->getEstado() . "|" .
                        $this->pedidoModelo->getEmpresa_aberta() . "|" .
                        $this->pedidoModelo->getMensagem_usuario_01() . "|" .
                        $this->pedidoModelo->getMensagem_usuario_02() . "|" .
                        $this->pedidoModelo->getStatus() . "|" .
                        $this->pedidoModelo->getTipoAlteracao() . "|" .
                        $this->pedidoModelo->getDataAlteracao() . "|" .
                        $this->pedidoModelo->getHoraAlteracao() . "|" .
                        $this->pedidoModelo->getId(), "id_empresa = ?");
                $id = $this->pedidoModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
        */
    }
    
    

    public function buscarTodosPedidos() {
        try {
            $sql = parent::selecionar("pedido", "id_pedido,data_pedido,hora_pedido,id_cliente,status,total_pedido,taxa_entrega,obs_pedido,previsao_entrega,data_cancelado,hora_cancelado,motivo_cancelado", "1 = 1");
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