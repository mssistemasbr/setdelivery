<?php

class HorarioFuncionamentoControle extends Crud {

    private $horarioModelo;

    public function salvarHorario(HorarioFuncionamentoModelo $horarioModelo) {
        $this->horarioModelo = $horarioModelo;
        try {
            if ($this->horarioModelo->getId() == 0):
                $id = parent::inserir("horario_funcionamento", "id_horario,segunda,terca,quarta,quinta,sexta,sabado,domingo,data_cadastro,hora_cadastro,tipo_cadastro",
                                $this->horarioModelo->getId() . "|" .
                                $this->horarioModelo->getSegunda() . "|" .
                                $this->horarioModelo->getTerca() . "|" .
                                $this->horarioModelo->getQuarta() . "|" .
                                $this->horarioModelo->getQuinta() . "|" .
                                $this->horarioModelo->getSexta() . "|" .
                                $this->horarioModelo->getSabado() . "|" .
                                $this->horarioModelo->getDomingo() . "|" .
                                $this->horarioModelo->getDataCadastro() . "|" .
                                $this->horarioModelo->getHoraCadastro() . "|" .
                                $this->horarioModelo->getTipoCadastro());
            else:
                parent::atualizar("horario_funcionamento", "segunda,terca,quarta,quinta,sexta,sabado,domingo,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->horarioModelo->getSegunda() . "|" .
                        $this->horarioModelo->getTerca() . "|" .
                        $this->horarioModelo->getQuarta() . "|" .
                        $this->horarioModelo->getQuinta() . "|" .
                        $this->horarioModelo->getSexta() . "|" .
                        $this->horarioModelo->getSabado() . "|" .
                        $this->horarioModelo->getDomingo() . "|" .
                        $this->horarioModelo->getDataAlteracao() . "|" .
                        $this->horarioModelo->getHoraAlteracao() . "|" .
                        $this->horarioModelo->getTipoAlteracao() . "|" .
                        $this->horarioModelo->getId(), "id_horario = ?");
                $id = $this->horarioModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTodosHorario() {
        try {
            $sql = parent::selecionar("horario_funcionamento", "id_horario,segunda,terca,quarta,quinta,sexta,sabado,domingo", "1 = 1");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarHorarioId($id) {
        try {
            $sql = parent::selecionar("horario_funcionamento", "id_horario,segunda,terca,quarta,quinta,sexta,sabado,domingo", "id_horario = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarHorario($id) {
        try {
            parent::deletar("horario_funcionamento", "id_horario = '" . $id . "'");
            return($id);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>