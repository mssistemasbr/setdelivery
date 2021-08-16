<?php

class TipoProdutoControle extends Crud {

    private $tipoProdutoModelo;

    public function salvarTipoProduto(TipoProdutoModelo $tipoProdutoModelo) {
        $this->tipoProdutoModelo = $tipoProdutoModelo;

        try {
            if ($this->tipoProdutoModelo->getId() == 0):
                $id = parent::inserir("tipo_produto", "id_tipo_produto,descricao,ativo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->tipoProdutoModelo->getId() . "|" .
                                $this->tipoProdutoModelo->getDescricao() . "|" .
                                $this->tipoProdutoModelo->getAtivo() . "|" .
                                $this->tipoProdutoModelo->getDataCadastro() . "|" .
                                $this->tipoProdutoModelo->getHoraCadastro() . "|" .
                                $this->tipoProdutoModelo->getTipoCadastro());
            else:
                parent::atualizar("tipo_produto", "descricao,ativo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->tipoProdutoModelo->getDescricao() . "|" .
                        $this->tipoProdutoModelo->getAtivo() . "|" .
                        $this->tipoProdutoModelo->getDataAlteracao() . "|" .
                        $this->tipoProdutoModelo->getHoraAlteracao() . "|" .
                        $this->tipoProdutoModelo->getTipoAlteracao() . "|" .
                        $this->tipoProdutoModelo->getId(), "id_tipo_produto = ?");
                $id = $this->tipoProdutoModelo->getId();
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

    public function buscarTodosTipoProdutoCategoria($categoria) {
        try {
            $sql = parent::selecionar("tipo_produto", "id_tipo_produto,descricao,subdescricao,ativo", "tipo_produto ='" . $categoria . "'");
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