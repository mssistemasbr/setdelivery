<?php

class FormaPagamentoControle extends Crud {

    private $formaPagamentoModelo;

    public function salvarFormaPagamento(FormaPagamentoModelo $formaPagamentoModelo) {
        $this->formaPagamentoModelo = $formaPagamentoModelo;

        try {
            if ($this->formaPagamentoModelo->getId() == 0):

                $id = parent::inserir("forma_pagto", "id_forma_pagto,descricao,ativo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->formaPagamentoModelo->getId() . "|" .
                                $this->formaPagamentoModelo->getDescricao() . "|" .
                                $this->formaPagamentoModelo->getAtivo() . "|" .
                                $this->formaPagamentoModelo->getDataCadastro() . "|" .
                                $this->formaPagamentoModelo->getHoraCadastro() . "|" .
                                $this->formaPagamentoModelo->getTipoCadastro());
            else:
                parent::atualizar("forma_pagto", "descricao,ativo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->formaPagamentoModelo->getDescricao() . "|" .
                        $this->formaPagamentoModelo->getAtivo() . "|" .
                        $this->formaPagamentoModelo->getDataAlteracao() . "|" .
                        $this->formaPagamentoModelo->getHoraAlteracao() . "|" .
                        $this->formaPagamentoModelo->getTipoAlteracao() . "|" .
                        $this->formaPagamentoModelo->getId(), "id_forma_pagto = ?");
                $id = $this->formaPagamentoModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarFormaPagamentoId($id) {
        try {
            $sql = parent::selecionar("forma_pagto", "id_forma_pagto,descricao,ativo", "id_forma_pagto = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosFormaPagamento() {
        try {
            $sql = parent::selecionar("forma_pagto", "id_forma_pagto,descricao,ativo", "1 = 1");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosFormaPagamentoAtivos() {
        try {
            $sql = parent::selecionar("forma_pagto", "id_forma_pagto, descricao", "ativo = 'S'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarFormaPagamento($id) {
        try {
            parent::deletar("forma_pagto", "id_forma_pagto = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>