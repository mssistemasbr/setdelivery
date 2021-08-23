<?php

class UsuarioControle extends Crud {

    private $usuarioModelo;

    public function validaUsuario(UsuarioModelo $usuarioModelo) {
        $this->usuarioModelo = $usuarioModelo;
        try {
            $usuario = json_decode(parent::selecionar("usuario", "id,nome,cpf,telefone,email,senha,empresa", "email ='" . $this->usuarioModelo->getEmail() . "'"));
            if (!empty($usuario)):
                foreach ($usuario as $us):
                    if ($us->email == $this->usuarioModelo->getEmail() && $us->senha == $this->usuarioModelo->getSenha()):
                        $_SESSION["ID_USUARIO"] = $us->id;
                        $_SESSION["NOME_USUARIO"] = $us->nome;
                        $_SESSION["ID_EMPRESA"] = $us->empresa;
                        return $us->id;
                    else:
                        return 0;
                    endif;
                endforeach;
            else :
                return 0;
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function protegePagina() {
        try {
            if (isset($_SESSION["ID_USUARIO"]) || isset($_SESSION["ID_EMPRESA"])) {
                return(true);
            } else {
                return(false);
            }
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function sair() {
        try {
            if (isset($_SESSION["ID_USUARIO"]) || isset($_SESSION["ID_EMPRESA"])) {
                session_unset();
                session_destroy();
                return(true);
            } else {
                return(false);
            }
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarImg($id) {
        $imagem = NULL;
        try {
            if ($id != ''):
                $img = UsuarioControle::buscarUsuarioId($id);
                if ($img == ''):
                    echo '';
                else:
                    foreach ($img as $img):
                        $imagem = $img[3];
                    endforeach;
                endif;
                if (!$imagem == NULL) :
                    if (file_exists('../imagens/usuario/' . $imagem)):
                        unlink('../imagens/usuario/' . $imagem);
                    else :
                        unlink('../imagens/usuario/' . $imagem);
                    endif;
                endif;
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function inserirUsuario(UsuarioModelo $usuarioModelo) {
        $this->usuarioModelo = $usuarioModelo;
        try {
            if ($this->usuarioModelo->getId() == ""):
                $id = parent::inserir("usuario", "id,nome,cpf,telefone,email,senha,status,empresa", $this->usuarioModelo->getId() . "|" .
                                $this->usuarioModelo->getNome() . "|" .
                                $this->usuarioModelo->getCpf() . "|" .
                                $this->usuarioModelo->getTelefone() . "|" .
                                $this->usuarioModelo->getEmail() . "|" .
                                $this->usuarioModelo->getSenha() . "|" .
                                $this->usuarioModelo->getStatus() . "|" .
                                $this->usuarioModelo->getEmpresa());
            else:
                parent::atualizar("usuario", "nome,cpf,telefone,email,senha,status,", $this->usuarioModelo->getNome() . "|" .
                        $this->usuarioModelo->getCpf() . "|" .
                        $this->usuarioModelo->getTelefone() . "|" .
                        $this->usuarioModelo->getEmail() . "|" .
                        $this->usuarioModelo->getSenha() . "|" .
                        $this->usuarioModelo->getStatus() . "|" .
                        $this->usuarioModelo->getId(), "id = ?");
                $id = $this->usuarioModelo->getId();
            endif;
            return($id);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarUsuarioId($id) {
        try {
            $sql = parent::selecionar("usuario", "id,nome,cpf,telefone,email,senha,status,empresa", "id = '$id'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function validaEmail($email) {
        try {
            $sql = json_decode(parent::selecionar("usuario", "email", "email = '" . $email . "'"));
            foreach ($sql as $email) :
                $em = $email->email;
            endforeach;
            return($em);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosUsuarios($id_empresa) {
        try {
            $sql = parent::selecionar("usuario", "id,nome,cpf,telefone,email,senha,status", "1 = 1 AND empresa = '" . $id_empresa . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarUsuario($id) {
        try {
            parent::deletar("usuario", "id = '" . $id . "'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }
    
        public function contadorUsuarioTotal() {
        try {
            $cont = parent::countregistros("usuario", "id", "");
            return($cont);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function contadorUsuarioTotalHoje() {
        try {
            $cont = parent::countregistros("usuario", "id", "data_cadastro=CURRENT_DATE()");
            return($cont);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function buscarUsuarioEmail($email) {
        try {
            $sql = parent::selecionar("usuario", "id,nome,cpf,telefone,email,senha,status,empresa", "email = '".$email."'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}
