<?php

class EnderecoClienteControle extends Crud {

    private $enderecoClienteModelo;

    public function inserirEnderecoCliente(EnderecoClienteModelo $enderecoClienteModelo) {
        $this->enderecoClienteModelo = $enderecoClienteModelo;
        try {
            if ($this->enderecoClienteModelo->getIdEnderecoCliente() == 0):
                parent::inserir("endereco_cliente", "id_endereco_cliente,descricao_endereco,cep,endereco,numero,bairro,cidade,complemento,ponto_referencia,id_local_entrega,id_cliente,ativo", $this->enderecoClienteModelo->getIdEnderecoCliente() . "|" .
                        $this->enderecoClienteModelo->getDescricaoEndereco() . "|" .
                        $this->enderecoClienteModelo->getCep() . "|" .
                        $this->enderecoClienteModelo->getEndereco() . "|" .
                        $this->enderecoClienteModelo->getNumero() . "|" .
                        $this->enderecoClienteModelo->getBairro() . "|" .
                        $this->enderecoClienteModelo->getCidade() . "|" .
                        $this->enderecoClienteModelo->getComplemento() . "|" .
                        $this->enderecoClienteModelo->getPontoReferencia() . "|" .
                        $this->enderecoClienteModelo->getIdLocalEntrega() . "|" .
                        $this->enderecoClienteModelo->getIdCliente() . "|" .
                        $this->enderecoClienteModelo->getAtivo());
            else:
                parent::atualizar("endereco_cliente", "descricao_endereco,cep,endereco,numero,bairro,cidade,complemento,ponto_referencia,id_local_entrega,id_cliente,ativo,", $this->enderecoClienteModelo->getDescricaoEndereco() . "|" .
                        $this->enderecoClienteModelo->getCep() . "|" .
                        $this->enderecoClienteModelo->getEndereco() . "|" .
                        $this->enderecoClienteModelo->getNumero() . "|" .
                        $this->enderecoClienteModelo->getBairro() . "|" .
                        $this->enderecoClienteModelo->getCidade() . "|" .
                        $this->enderecoClienteModelo->getComplemento() . "|" .
                        $this->enderecoClienteModelo->getPontoReferencia() . "|" .
                        $this->enderecoClienteModelo->getIdLocalEntrega() . "|" .
                        $this->enderecoClienteModelo->getIdCliente() . "|" .
                        $this->enderecoClienteModelo->getAtivo() . "|" .
                        $this->enderecoClienteModelo->getIdEnderecoCliente(), "id_endereco_cliente = ?");
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function atualizarEnderecoCliente_Inativo($id_endereco_cliente) {
        try {
            parent::atualizar("endereco_cliente", "ativo,", "N" . "|" . $id_endereco_cliente, "id_endereco_cliente = ?");
            return($id_endereco_cliente);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function buscarEnderecoClienteId($id) {
        try {
            $sql = parent::selecionar("endereco_cliente", "id_endereco_cliente,descricao_endereco,cep,endereco,numero,bairro,cidade,complemento,ponto_referencia", "id_endereco_cliente = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosEstados() {
        try {
            $sql = parent::selecionar("estado", "id,nome", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarEstadoId($id) {
        try {
            $sql = parent::selecionar("estado", "id,nome", "id = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarCidadeId($id) {
        try {
            $sql = parent::selecionar("cidade", "id,nome", "id = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarEndereco($id, $parametro) {
        try {
            parent::deletar("endereco", "$parametro = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>