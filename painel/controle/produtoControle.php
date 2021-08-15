<?php

class ProdutoControle extends Crud {

    private $produtoModelo;

    public function deletarFotoProduto($id) {
        try {
            if ($id != ''):
                $obj = json_decode(ProdutoControle::buscarProdutoId($id));
                if (empty($obj)):
                    echo '';
                else:
                    foreach ($obj as $img) :
                        $imagem = $img->foto_produto;
                    endforeach;
                    if (file_exists('../../img/produto/' . $imagem)):
                        chmod("../../img/produto/" . $imagem, 0777);
                        unlink('../../img/produto/' . $imagem);
                    endif;
                endif;
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function salvarImg($imagem, $id, $largura, $altura) {
        try {
            $arquivo = $imagem;
            $arquivo = $arquivo['name'];

            if ($arquivo != ""):
                ProdutoControle::deletarFotoProduto($id);
            endif;

            if (!empty($arquivo)) :
                $extensao = explode(".", $arquivo);
                if ($extensao[1] == 'jpg' || $extensao[1] == 'JPG') :
                    $arquivo = str_replace(".jpg", " ", $arquivo);
                    $arquivo = md5(uniqid(time())) . ".jpg";
                elseif ($extensao[1] == 'png' || $extensao[1] == 'PNG') :
                    $arquivo = str_replace(".png", " ", $arquivo);
                    $arquivo = md5(uniqid(time())) . ".png";
                elseif ($extensao[1] == 'jpeg' || $extensao[1] == 'JPEG') :
                    $arquivo = str_replace(".jpg", " ", $arquivo);
                    $arquivo = md5(uniqid(time())) . ".jpg";
                else :
                    $arquivo = "";
                endif;
            endif;

            if (!empty($arquivo)) :
                $img = new TImagens($imagem);
                if ($extensao[1] == 'jpg') :
                    chmod("../../img/produto/", 0777);
                    $img->ResizeImage($largura, $altura, true);
                    $img->WriteImage('jpeg', 'img_tmp.jpg', 100);
                    $caminho_img = "../../img/produto/";
                    rename("img_tmp.jpg", $caminho_img . $arquivo);
                else :
                    chmod("../../img/produto/", 0777);
                    $img->ResizeImage($largura, $altura, true);
                    $img->WriteImage('png', 'img_tmp.png', 100);
                    $caminho_img = "../../img/produto/";
                    rename("img_tmp.png", $caminho_img . $arquivo);
                endif;
            endif;
            return($arquivo);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function salvarProduto(ProdutoModelo $produtoModelo) {
        $this->produtoModelo = $produtoModelo;

        try {
            $img = $this->produtoModelo->getFoto();
            if ($this->produtoModelo->getId() == 0):
                $id = parent::inserir("produto", "id_produto,nome_produto,subdescricao,valor_produto," . ($img == "" ? "" : "foto_produto,") . "ativo,id_tipo_produto,tipo_cadastro,data_cadastro,hora_cadastro",
                                $this->produtoModelo->getId() . "|" .
                                $this->produtoModelo->getNome() . "|" .
                                $this->produtoModelo->getSubdescricao() . "|" .
                                $this->produtoModelo->getValor() . "|" .
                                ($img == "" ? "" : $this->produtoModelo->getFoto() . "|" ) .
                                $this->produtoModelo->getAtivo() . "|" .
                                $this->produtoModelo->getIdTipoProduto() . "|" .
                                $this->produtoModelo->getTipoCadastro() . "|" .
                                $this->produtoModelo->getDataCadastro() . "|" .
                                $this->produtoModelo->getHoraCadastro());
            else:
                parent::atualizar("produto", "nome_produto,subdescricao,valor_produto," . ($img == "" ? "" : "foto_produto,") . "ativo,id_tipo_produto,data_alteracao,hora_alteracao,tipo_alteracao,",
                        $this->produtoModelo->getNome() . "|" .
                        $this->produtoModelo->getSubdescricao() . "|" .
                        $this->produtoModelo->getValor() . "|" .
                        ($img == "" ? "" : $this->produtoModelo->getFoto() . "|" ) .
                        $this->produtoModelo->getAtivo() . "|" .
                        $this->produtoModelo->getIdTipoProduto() . "|" .
                        $this->produtoModelo->getDataAlteracao() . "|" .
                        $this->produtoModelo->getHoraAlteracao() . "|" .
                        $this->produtoModelo->getTipoAlteracao() . "|" .
                        $this->produtoModelo->getId(), "id_produto = ?");
                $id = $this->produtoModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTodosProdutos() {
        try {
            $sql = parent::selecionar("produto", "id_produto,nome_produto,subdescricao,valor_produto,foto_produto,ativo,id_tipo_produto,tipo_cadastro", "1 = 1");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosProduto_InnerJoin() {
        try {
            $sql = parent::selecionarJoin("produto p", "p.id_produto, p.nome_produto, p.subdescricao, p.valor_produto, p.ativo, t.descricao", "inner join tipo_produto t on (p.id_tipo_produto = t.id_tipo_produto)");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarProdutoId($id) {
        try {
            $sql = parent::selecionar("produto", "nome_produto,subdescricao,valor_produto,foto_produto,ativo,id_tipo_produto,tipo_cadastro", "id_produto = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarProduto($id) {
        try {
            parent::deletar("produto", "id_produto = '" . $id . "'");
            return($id);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function contadorProdutoTotal() {
        try {
            $cont = parent::countregistros("produto", "id_produto", "");
            return($cont);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function contadorProdutoTotalHoje() {
        try {
            $cont = parent::countregistros("produto", "id_produto", "data_cadastro=CURRENT_DATE()");
            return($cont);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>