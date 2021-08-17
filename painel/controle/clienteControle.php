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
                parent::atualizar("cliente", "nome_cliente,telefone_celular,senha,",
                        $this->clienteModelo->getNomeCliente() . "|" .
                        $this->clienteModelo->getTelefoneCelular() . "|" .
                        $this->clienteModelo->getSenha() . "|" .
                        $this->clienteModelo->getIdCliente(), "id_cliente = ?");
                $id = $this->clienteModelo->getIdCliente();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarClienteId($id) {
        try {
            $sql = parent::selecionar("cliente", "id_cliente,nome_cliente,telefone_celular,email,senha,ativo", "id_cliente = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosClientes() {
        try {
            $sql = parent::selecionar("cliente", "id_cliente,nome_cliente,telefone_celular,email,senha,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarCliente($id) {
        try {
            parent::deletar("cliente", "id_cliente = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>