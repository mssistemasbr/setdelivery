<?php

class ClienteControle extends Crud {

    private $clienteModelo;

    public function salvarCliente(ClienteModelo $clienteModelo) {
        $this->clienteModelo = $clienteModelo;

        try {
            if ($this->clienteModelo->getIdCliente() == 0):
                $id = parent::inserir("cliente", "id_cliente,nome_cliente,telefone_celular,email,senha",
                                $this->clienteModelo->getIdCliente() . "|" .
                                $this->clienteModelo->getNomeCliente() . "|" .
                                $this->clienteModelo->getTelefoneCelular() . "|" .
                                $this->clienteModelo->getEmail() . "|" .
                                $this->clienteModelo->getSenha());
            else:
                parent::atualizar("cliente", "nome_cliente,telefone_celular,",
                        $this->clienteModelo->getNomeCliente() . "|" .
                        $this->clienteModelo->getTelefoneCelular() . "|" .
                        $this->clienteModelo->getIdCliente(), "id_cliente = ?");
                $id = $this->clienteModelo->getIdCliente();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTipoProdutoId($id) {
        try {
            $sql = parent::selecionar("tipo_produto", "id_tipo_produto,descricao,ativo", "id_tipo_produto = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosTipoProduto() {
        try {
            $sql = parent::selecionar("tipo_produto", "id_tipo_produto,descricao,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarTipoProduto($id) {
        try {
            parent::deletar("tipo_produto", "id_tipo_produto = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>