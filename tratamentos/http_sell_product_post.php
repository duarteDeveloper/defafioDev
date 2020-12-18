<?php
require('C:/xampp/htdocs/avaliacao_dev/controller/produtoController.php');

if($_POST) {
    $oProduto = new produtoController();

    echo json_encode($oProduto->PushSell($_POST));
}
