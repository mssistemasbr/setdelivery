<?php

class EnderecoControle extends Crud {

    private $enderecoModelo;

    public function inserirEndereco(EnderecoModelo $enderecoModelo) {
        $this->enderecoModelo = $enderecoModelo;
        try {
            if ($this->enderecoModelo->getId() == 0):
                parent::inserir("endereco", "id,estado,cidade,bairro,endereco,numero,cep,cliente", $this->enderecoModelo->getId() . "|" .
                        $this->enderecoModelo->getEstado() . "|" .
                        $this->enderecoModelo->getCidade() . "|" .
                        $this->enderecoModelo->getBairro() . "|" .
                        $this->enderecoModelo->getEndereco() . "|" .
                        $this->enderecoModelo->getNumero() . "|" .
                        $this->enderecoModelo->getCep() . "|" .
                        $this->enderecoModelo->getCliente());
            else:
                parent::atualizar("endereco", "estado,cidade,bairro,endereco,numero,cep,", $this->enderecoModelo->getEstado() . "|" .
                        $this->enderecoModelo->getCidade() . "|" .
                        $this->enderecoModelo->getBairro() . "|" .
                        $this->enderecoModelo->getEndereco() . "|" .
                        $this->enderecoModelo->getNumero() . "|" .
                        $this->enderecoModelo->getCep() . "|" .
                        $this->enderecoModelo->getId(), "id = ?");
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarEnderecoId($id, $parametro) {
        try {
            $sql = parent::selecionar("endereco", "id,estado,cidade,bairro,endereco,numero,cep", "$parametro = '$id'");
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