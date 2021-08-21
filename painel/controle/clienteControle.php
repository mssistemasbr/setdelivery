<?php

class ClienteControle extends Crud {

    private $clienteModelo;

    public function salvarCliente(ClienteModelo $clienteModelo) {
        $this->clienteModelo = $clienteModelo;

        try {
            if ($this->clienteModelo->getIdCliente() == 0):
                $id = parent::inserir("cliente", "id_cliente,nome_cliente,telefone_celular,email,senha,data_cadastro,hora_cadastro,tipo_cadastro,ativo",
                                $this->clienteModelo->getIdCliente() . "|" .
                                $this->clienteModelo->getNomeCliente() . "|" .
                                $this->clienteModelo->getTelefoneCelular() . "|" .
                                $this->clienteModelo->getEmail() . "|" .
                                $this->clienteModelo->getSenha() . "|" .
                                $this->clienteModelo->getDataCadastro() . "|" .
                                $this->clienteModelo->getHoraCadastro() . "|" .
                                $this->clienteModelo->getTipoCadastro() . "|" .
                                $this->clienteModelo->getAtivo());
            else:
                parent::atualizar("cliente", "nome_cliente,telefone_celular,senha,data_alteracao,hora_alteracao,tipo_alteracao,ativo,",
                        $this->clienteModelo->getNomeCliente() . "|" .
                        $this->clienteModelo->getTelefoneCelular() . "|" .
                        $this->clienteModelo->getSenha() . "|" .
                        $this->clienteModelo->getDataAlteracao() . "|" .
                        $this->clienteModelo->getHoraAlteracao() . "|" .
                        $this->clienteModelo->getTipoAlteracao() . "|" .
                        $this->clienteModelo->getAtivo() . "|" . 
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

    public function checkEmailCliente($email) {
        try {
            $sql = json_decode(parent::selecionar("cliente", "email", "email = '" . $email . "'"));
            foreach ($sql as $email) :
                $checkEmail = $email->email;
            endforeach;
            return($checkEmail);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function checkTelefoneCliente($telefone_celular) {
        try {
            $sql = json_decode(parent::selecionar("cliente", "telefone_celular", "telefone_celular = '" . $telefone_celular . "'"));
            foreach ($sql as $telefone_celular) :
                $checkTelefone = $telefone_celular->telefone_celular;
            endforeach;
            return($checkTelefone);
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