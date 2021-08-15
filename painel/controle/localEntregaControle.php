<?php

class LocalEntregaControle extends Crud {

    private $localEntregaModelo;

    public function salvarLocalEntrega(LocalEntregaModelo $localEntregaModelo) {
        $this->localEntregaModelo = $localEntregaModelo;

        try {
            if ($this->localEntregaModelo->getId() == 0):
                $id = parent::inserir("local_entrega", "id_local_entrega,descricao,ativo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->localEntregaModelo->getId() . "|" .
                                $this->localEntregaModelo->getDescricao() . "|" .
                                $this->localEntregaModelo->getAtivo() . "|" .
                                $this->localEntregaModelo->getDataCadastro() . "|" .
                                $this->localEntregaModelo->getHoraCadastro() . "|" .
                                $this->localEntregaModelo->getTipoCadastro());

            else:
                parent::atualizar("local_entrega", "descricao,ativo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->localEntregaModelo->getDescricao() . "|" .
                        $this->localEntregaModelo->getAtivo() . "|" .
                         $this->localEntregaModelo->getDataAlteracao() . "|" .
                         $this->localEntregaModelo->getHoraAlteracao() . "|" .
                         $this->localEntregaModelo->getTipoAlteracao() . "|" .
                        $this->localEntregaModelo->getId(), "id_local_entrega = ?");
                $id = $this->localEntregaModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarLocalEntregaId($id) {
        try {
            $sql = parent::selecionar("local_entrega", "id_local_entrega,descricao,ativo", "id_local_entrega = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosLocalEntrega() {
        try {
            $sql = parent::selecionar("local_entrega", "id_local_entrega,descricao,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosLocalEntregaAtivos() {
        try {
            $sql = parent::selecionar("local_entrega", "id_local_entrega,descricao", "ativo = 'S'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarLocalEntrega($id) {
        try {
            parent::deletar("local_entrega", "id_local_entrega = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>