<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);

include ("../config/crud.php");
include ("../controle/usuarioControle.php");
include ("../modelo/usuarioModelo.php");
include ("../controle/checkControle.php");
include ("../controle/servicoControle.php");
include ("../controle/areaControle.php");
include ("../controle/sistemaControle.php");
include ("../controle/checklistControle.php");
include ("../controle/itensChecklistControle.php");
include ("../controle/fotoChecklistControle.php");

include ("../modelo/checklistModelo.php");
include ("../modelo/itensChecklistModelo.php");
include ("../modelo/fotoChecklistModelo.php");

$json = file_get_contents('php://input');
$obj = json_decode($json);

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    if ($obj->status == 'login'):
        $usuarioModelo = new UsuarioModelo();
        $usuarioModelo->setEmail(utf8_decode($obj->email));
        $usuarioModelo->setSenha(utf8_decode($obj->senha));

        $usuarioContro = new UsuarioControle();
        $login = $usuarioContro->validaUsuario($usuarioModelo);
        if ($login != 0) {
            $uControle = new UsuarioControle();
            $json = $uControle->buscarUsuarioId($login);
            echo substr($json, 1, strlen($json) - 2);
        } else {
            echo 'error';
        }
    elseif ($obj->status == 'atualizarCheck'):
        $nCheckControle = new CheckControle();
        $jsonC = $nCheckControle->buscarTodosCheck($obj->empresa);
        if (count($jsonC) > 0) {
            echo utf8_decode($jsonC);
        } else {
            echo 'error';
        }
    elseif ($obj->status == 'atualizarItens'):
        $iControle = new ServicoControle();
        $json = $iControle->buscarTodosServico($obj->empresa);
        if (count($json) > 0) {
            echo utf8_decode($json);
        } else {
            echo 'error';
        }
    elseif ($obj->status == 'atualizarArea'):
        $aControle = new AreaControle();
        $jsonA = $aControle->buscarTodasAreas($obj->empresa);
        if (count($jsonA) > 0) {
            echo utf8_decode($jsonA);
        } else {
            echo 'error';
        }
    elseif ($obj->status == 'atualizarSistemaControle'):
        $sControle = new SistemaControle();
        $jsonS = $sControle->buscarTodosSistemaControle($obj->empresa);
        if (count($jsonS) > 0) {
            echo utf8_decode($jsonS);
        } else {
            echo 'error';
        }
    elseif ($obj->status == 'salvarChecklist'):
        $checklistModelo = new ChecklistModelo();
        $checklistModelo->setId("");
        $checklistModelo->setId_check($obj->id_check);
        $checklistModelo->setId_area($obj->id_area);
        $checklistModelo->setId_sistema_controle($obj->id_sistema_controle);
        $checklistModelo->setObs($obj->obs);
        $checklistModelo->setData($obj->data);
        $checklistModelo->setUsuario($obj->usuario);
        $checklistModelo->setEmpresa($obj->empresa);

        $checklistControle = new ChecklistControle();
        $id = $checklistControle->salvarChecklist($checklistModelo);
        if ($id != 0):
            echo 'ok';
        else:
            echo 'erro';
        endif;
    elseif ($obj->status == 'salvarItemChecklist'):
        $itensChecklistModelo = new ItensChecklistModelo();
        $itensChecklistModelo->setId("");
        $itensChecklistModelo->setId_item($obj->id_item);
        $itensChecklistModelo->setChecagem($obj->checagem);
        $itensChecklistModelo->setId_checklist($obj->id_checklist);
        $itensChecklistModelo->setData(date('y-m-d'));
        $itensChecklistModelo->setEmpresa($obj->empresa);

        $itensChecklistControle = new ItensChecklistControle();
        $id = $itensChecklistControle->salvarItemChecklist($itensChecklistModelo);
        if ($id != 0):
            echo 'ok';
        else:
            echo 'erro';
        endif;
    elseif ($obj->status == 'salvarFotoChecklist'):
        $fotoChecklistModelo = new FotoChecklistModelo();
        $fotoChecklistModelo->setId("");
        $fotoChecklistModelo->setFoto($obj->foto);
        $fotoChecklistModelo->setId_checklist($obj->id_checklist);
        $fotoChecklistModelo->setEmpresa($obj->empresa);

        $fotoChecklistControle = new FotoChecklistControle();
        $id = $fotoChecklistControle->salvarFotoChecklist($fotoChecklistModelo);
        if ($id != 0):
            echo 'ok';
        else:
            echo 'erro';
        endif;
    elseif ($obj->status == 'atualizarPastas'):
        Show_files("../procedimentos");
    endif;

else:
    echo Show_files("../procedimentos");

    function Show_files($local) {

        if (!$local) {
            return false;
        }

        if (!is_dir($local)) {
            $jsonArquivos .= '{"dir":"' . substr($local, 3, strlen($local)) . '"},';
            echo $jsonArquivos;
        } else {
            $dir = opendir($local);
            while ($file = readdir($dir)) {
                if ($file != "." && $file != ".." && $file != ".htaccess") {
                    Show_files($local . "/" . $file, 1);
                    unset($file);
                }
            }
            closedir($dir);
            unset($dir);
        }
    }

endif;

function Show_files($local) {

    if (!$local) {
        return false;
    }

    if (!is_dir($local)) {
        $jsonArquivos .= '{"dir":"' . substr($local, 3, strlen($local)) . '"},';
        echo $jsonArquivos;
    } else {
        $dir = opendir($local);
        while ($file = readdir($dir)) {
            if ($file != "." && $file != ".." && $file != ".htaccess") {
                Show_files($local . "/" . $file, 1);
                unset($file);
            }
        }
        closedir($dir);
        unset($dir);
    }
}

?>