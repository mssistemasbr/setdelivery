<?php

class EmpresaControle extends Crud {

    private $empresaModelo;

    public function salvarEmpresa(EmpresaModelo $empresaModelo) {
        $this->empresaModelo = $empresaModelo;
        try {
            if ($this->empresaModelo->getId() == 0):
                $id = parent::inserir("empresa", "id_empresa,nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status,tipo_cadastro,data_cadastro,hora_cadastro",
                                $this->empresaModelo->getId() . "|" .
                                $this->empresaModelo->getNome() . "|" .
                                $this->empresaModelo->getApelido() . "|" .
                                $this->empresaModelo->getTelefone() . "|" .
                                $this->empresaModelo->getCidade() . "|" .
                                $this->empresaModelo->getEstado() . "|" .
                                $this->empresaModelo->getEmpresa_aberta() . "|" .
                                $this->empresaModelo->getMensagem_usuario_01() . "|" .
                                $this->empresaModelo->getMensagem_usuario_02() . "|" .
                                $this->empresaModelo->getStatus() . "|" .
                                $this->empresaModelo->getTipoCadastro() . "|" .
                                $this->empresaModelo->getDataCadastro() . "|" .
                                $this->empresaModelo->getHoraCadastro());
            else:
                parent::atualizar("empresa", "nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status,tipo_alteracao,data_alteracao,hora_alteracao,",
                        $this->empresaModelo->getNome() . "|" .
                        $this->empresaModelo->getApelido() . "|" .
                        $this->empresaModelo->getTelefone() . "|" .
                        $this->empresaModelo->getCidade() . "|" .
                        $this->empresaModelo->getEstado() . "|" .
                        $this->empresaModelo->getEmpresa_aberta() . "|" .
                        $this->empresaModelo->getMensagem_usuario_01() . "|" .
                        $this->empresaModelo->getMensagem_usuario_02() . "|" .
                        $this->empresaModelo->getStatus() . "|" .
                        $this->empresaModelo->getTipoAlteracao() . "|" .
                        $this->empresaModelo->getDataAlteracao() . "|" .
                        $this->empresaModelo->getHoraAlteracao() . "|" .
                        $this->empresaModelo->getId(), "id_empresa = ?");
                $id = $this->empresaModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTodasEmpresa() {
        try {
            $sql = parent::selecionar("empresa", "id_empresa,nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status", "1 = 1");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarEmpresaId($id) {
        try {
            $sql = parent::selecionar("empresa", "id_empresa,nome_empresa,apelido,telefone_principal,cidade,estado,empresa_aberta,mensagem_usuario_01,mensagem_usuario_02,status", "id_empresa = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function atualizarEmpresa($id) {
        try {
            parent::atualizar("empresa", "status,", 0 . "|" . $id, "id = ?");
            return($id);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>