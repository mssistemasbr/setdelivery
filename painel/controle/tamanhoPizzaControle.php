<?php

class TamanhoPizzaControle extends Crud {

    private $tamanhoPizzaModelo;

    public function salvarTamanhoPizza(TamanhoPizzaModelo $tamanhoPizzaModelo) {
        $this->tamanhoPizzaModelo = $tamanhoPizzaModelo;

        try {
            if ($this->tamanhoPizzaModelo->getId() == 0):
                $id = parent::inserir("tamanho_pizza", "id_tamanho_pizza,descricao,subdescricao,ativo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->tamanhoPizzaModelo->getId() . "|" .
                                $this->tamanhoPizzaModelo->getDescricao() . "|" .
                                $this->tamanhoPizzaModelo->getSubDescricao() . "|" .
                                $this->tamanhoPizzaModelo->getAtivo() . "|" .
                                $this->tamanhoPizzaModelo->getDataCadastro() . "|" .
                                $this->tamanhoPizzaModelo->getHoraCadastro() . "|" .
                                $this->tamanhoPizzaModelo->getTipoCadastro());
            else:
                parent::atualizar("tamanho_pizza", "descricao,subdescricao,ativo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->tamanhoPizzaModelo->getDescricao() . "|" .
                        $this->tamanhoPizzaModelo->getSubDescricao() . "|" .
                        $this->tamanhoPizzaModelo->getAtivo() . "|" .
                        $this->tamanhoPizzaModelo->getDataAlteracao() . "|" .
                        $this->tamanhoPizzaModelo->getHoraAlteracao() . "|" .
                        $this->tamanhoPizzaModelo->getTipoAlteracao() . "|" .
                        $this->tamanhoPizzaModelo->getId(), "id_tamanho_pizza = ?");
                $id = $this->tamanhoPizzaModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTamanhoPizzaId($id) {
        try {
            $sql = parent::selecionar("tamanho_pizza", "id_tamanho_pizza,descricao,subdescricao,ativo", "id_tamanho_pizza = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosTamanhoPizza() {
        try {
            $sql = parent::selecionar("tamanho_pizza", "id_tamanho_pizza,descricao,subdescricao,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarTamanhoPizza($id) {
        try {
            parent::deletar("tamanho_pizza", "id_tamanho_pizza = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>