<?php
require('C:/xampp/htdocs/avaliacao_dev/controller/produtoController.php');

if($_POST) {
    $oProduto = new produtoController();

    $_POST = trataObjectFromPost($_POST);

    echo json_encode($oProduto->PushUpdate($_POST));
}


function trataObjectFromPost($oData) {
    if($oData) {
        $oData['id_produto'] = (int) $oData['id_produto'];
        $oData['qtd_produto'] = (int) $oData['qtd_produto'];
        $oData['codigo_barra'] = (int) $oData['codigo_barra'];
    }

    return $oData;
}
