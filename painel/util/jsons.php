<?php

class Json extends Crud {

    public function jsonCidade($estado) {
        try {
            echo parent::json("cidade", "id,nome", "estado = '" . $estado . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }
    
    public function jsonEpi($empresa) {
        try {
            echo parent::json("epi_epc", "id,descricao", "empresa = '" . $empresa . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}
?>

