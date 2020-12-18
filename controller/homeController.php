<?php
require_once('C:/xampp/htdocs/avaliacao_dev/model/produtoModel.php');

class homeController {
    private $produtoModel;

    public function __construct(){
        $this->produtoModel = new produtoModel();
    }

    /**
    * MÉTODO QUE TRANSFORMA ARRAYS EM OBJETO
    */

    public function toObject($data = false) {
        return json_decode(json_encode($data));
    }

    public function getData() {
        try {

            $oData = $this->toObject(Array('form' => []));

            $oData->form = $this->produtoModel->listarFromCounter();

            if(!isset($oData)) {
                throw new Exception("Ocorreu um erro ao processar as informações.");
            }

            return $this->toObject(Array('error' => false, 'info' => $oData));
        } catch (Exception $e) {
            return $this->toObject(Array('error' => true, 'mensagem' => $e->getMessage()));
        }

    }
}
