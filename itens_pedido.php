<?php
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("./painel/config/crud.php");
include ("./painel/controle/itemPedidoControle.php");
$sqlItemPedido = new ItemPedidoControle();
$objItemPedido = json_decode($sqlItemPedido->buscarItemPedidoSessao($_POST['sessao']));
if (count($objItemPedido) > 0):
    $i = 0;
    foreach ($objItemPedido as $item):
        $i++;
        $valorTotalItem = $item->valor_pizza + $item->valor_acrescimo + $item->valor_borda;
        $valorTotalPedido = $valorTotalItem + $valorTotalPedido;
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-start" id="lista-pedido">
            <input type="hidden" value=" <?= $valorTotalItem ?>" id="valor-item-<?= $i ?>"/>
            <div class="ms-2 me-auto">
                <div class="fw-bold"><img src="assets/img/guarana.png"/><?= $item->nome_pizza ?><i onclick="deletarItemPedido(<?= $item->id_item ?>)" class="fas fa-times fa-trash"></i></div>
            </div>
            <span class="badge mt-3" style="width: 25%;padding: 0">
                <button onclick="somaQtdeItem(0, <?= $i ?>)" class="btn btn-primary text-center" id="soma-itens-pedido">+</button>
                <input type="text" id="qtd-itens-pedido" name="<?= $i ?>" value="<?= $item->qtde ?>" style="width: 37%" class="form-control text-center"/>
                <button onclick="somaQtdeItem(1,<?= $i ?>)" class="btn btn-primary text-sm-left" id="diminui-itens-pedido">-</button>          
            </span>
        </li>        
        <?php
    endforeach;
    echo "|" . $valorTotalPedido;
endif;
?>