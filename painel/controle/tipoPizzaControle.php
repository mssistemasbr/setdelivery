<?php

class TipoPizzaControle extends Crud {

    private $tipoPizzaModelo;

    public function salvarTipoPizza(TipoPizzaModelo $tipoPizzaModelo) {
        $this->tipoPizzaModelo = $tipoPizzaModelo;

        try {
            if ($this->tipoPizzaModelo->getId() == 0):
                $id = parent::inserir("tipo_pizza", "id_tipo_pizza,descricao,subdescricao,ativo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->tipoPizzaModelo->getId() . "|" .
                                $this->tipoPizzaModelo->getDescricao() . "|" .
                                $this->tipoPizzaModelo->getSubDescricao() . "|" .
                                $this->tipoPizzaModelo->getAtivo() . "|" .
                                $this->tipoPizzaModelo->getDataCadastro() . "|" .
                                $this->tipoPizzaModelo->getHoraCadastro() . "|" .
                                $this->tipoPizzaModelo->getTipoCadastro());

            else:
                parent::atualizar("tipo_pizza", "descricao,subdescricao,ativo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->tipoPizzaModelo->getDescricao() . "|" .
                        $this->tipoPizzaModelo->getSubDescricao() . "|" .
                        $this->tipoPizzaModelo->getAtivo() . "|" .
                        $this->tipoPizzaModelo->getDataAlteracao() . "|" .
                        $this->tipoPizzaModelo->getHoraAlteracao() . "|" .
                        $this->tipoPizzaModelo->getTipoAlteracao() . "|" .
                        $this->tipoPizzaModelo->getId(), "id_tipo_pizza = ?");
                $id = $this->tipoPizzaModelo->getId();
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