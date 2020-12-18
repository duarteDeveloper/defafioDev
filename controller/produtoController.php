<?php
/**
* INSTANCIA DA CLASSE PRODUTO MODEL
*/
require_once('C:/xampp/htdocs/avaliacao_dev/model/produtoModel.php');

class produtoController {
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

    public function PushSell($post) {
        try {
            /**
            * TRANSFORMA INFORMAÇÕES EM OBJETO
            */
            $post = $this->toObject($post);

            $this->trataDadosFromSell($post);

            $oProductInfo = $this->produtoModel->getProdutoFromId($post->id_produto);


            if($oProductInfo->qtd_produto < $post->qtd_produto) {
                throw new Exception("A quantidade de produtos no estoque é menor do quê a que você escolheu, preencha o campo novamente.");
            }

            if(isset($post->checker_update)) {
                $post->bSqlUpdateFromSingleValue = $this->produtoModel->updateFromSingleValue($post->id_produto, $post->valor_produto);
            }

            $post->valor_total_venda = $post->valor_produto * $post->qtd_produto;

            $post->bSqlSell = $this->produtoModel->InsertFromSellProduct($post->id_produto, $post->valor_produto, $post->qtd_produto, (float)$post->valor_total_venda);
            $post->bSqlUpdateProductAfterSell = $this->produtoModel->updateProductAfterSellItem($post->id_produto, $post->qtd_produto, $post->valor_total_venda);

            return Array('error' => false, 'mensagem' => 'Produto vendido com sucesso!', 'info' => $post);
        } catch (Exception $e) {
            return Array('error' => true, 'mensagem' => $e->getMessage());
        }
    }

    private function trataDadosFromSell($post = false) {
        if(empty($post->id_produto)) {
            throw new Exception("Selecione um Produto para vender");
        }

        if(empty($post->qtd_produto)) {
            throw new Exception("Escolha uma quantidade");
        }

        if(empty($post->valor_produto)) {
            throw new Exception("Defina o valor unitário do produto");
        }
    }

    public function PushRestore($post = false) {
        try {
            /**
            * TRANSFORMA INFORMAÇÕES EM OBJETO
            */
            $post = $this->toObject($post);

            /**
            * REALIZA UPDATE SE ESTIVER TUDO OK.
            */

            $post->bSqlRestore = $this->produtoModel->updateToProductList($post->id_produto);

            return Array('error' => false, 'mensagem' => 'Produto restaurado com sucesso!', 'info' => $post);
        } catch (Exception $e) {
            return Array('error' => true, 'mensagem' => $e->getMessage());
        }
    }

    public function PushRemove($post = false) {
        try {
            /**
            * TRANSFORMA INFORMAÇÕES EM OBJETO
            */
            $post = $this->toObject($post);

            /**
            * REALIZA UPDATE SE ESTIVER TUDO OK.
            */

            $post->bSqlRemove = $this->produtoModel->updateToTrash($post->id_produto);

            return Array('error' => false, 'mensagem' => 'Produto excluído com sucesso!', 'info' => $post);
        } catch (Exception $e) {
            return Array('error' => true, 'mensagem' => $e->getMessage());
        }
    }

    public function PushInsert($post = false) {
        try {
            /**
            * TRANSFORMA INFORMAÇÕES EM OBJETO
            */
            $post = $this->toObject($post);

            /**
            * TRATAMENTO DE INFORMAÇÕES
            */
            $this->trataDados($post);

            /**
            * REALIZA UPDATE SE ESTIVER TUDO OK.
            */
            // $post->valor_produto = floatval($post->valor_produto);

            $post->bSqlInsert = $this->produtoModel->inserir($post->nome_produto, $post->valor_produto, (int)$post->qtd_produto, $post->codigo_barra);

            return Array('error' => false, 'mensagem' => 'Produto adicionado com sucesso!', 'info' => $post);
        } catch (Exception $e) {
            return Array('error' => true, 'mensagem' => $e->getMessage());
        }
    }

    public function PushUpdate($post = false) {
        try {
            /**
            * TRANSFORMA INFORMAÇÕES EM OBJETO
            */
            $post = $this->toObject($post);

            /**
            * TRATAMENTO DE INFORMAÇÕES
            */
            $this->trataDados($post);

            /**
            * REALIZA UPDATE SE ESTIVER TUDO OK.
            */

            $post->bSqlUpdate = $this->produtoModel->editar($post->id_produto, $post->nome_produto, $post->valor_produto, $post->qtd_produto, $post->codigo_barra);

            return Array('error' => false, 'mensagem' => 'Alterações realizadas com sucesso!', 'info' => $post);
        } catch (Exception $e) {
            return Array('error' => true, 'mensagem' => $e->getMessage());
        }
    }

    private function trataDados($post) {
        if(empty($post->nome_produto)) {
            throw new Exception("Preencha o campo com o nome do produto.");
        }

        if(empty($post->valor_produto)) {
            throw new Exception("Preencha o campo com o valor do produto.");
        }

        if(empty($post->qtd_produto)) {
            throw new Exception("Preencha o campo com quantidade do produto.");
        }

        if(empty($post->codigo_barra)) {
            throw new Exception("Preencha o campo com o código de barras do produto.");
        }

        return $post;

    }

    public function getDataEdit($id_produto) {
        try {

            $oData = $this->toObject(Array('form' => []));

            $oData->form = $this->produtoModel->getProdutoFromId($id_produto);

            if(!isset($oData)) {
                throw new Exception("Ocorreu um erro ao processar as informações.");
            }

            return $this->toObject(Array('error' => false, 'info' => $oData));
        } catch (Exception $e) {
            return $this->toObject(Array('error' => true, 'mensagem' => $e->getMessage()));
        }

    }

    public function getData() {
        try {
            $oData = $this->toObject(Array('form' => []));

            $oData->form = $this->trataDataFromLista($this->produtoModel->listar());

            if(!isset($oData)) {
                throw new Exception("Ocorreu um erro ao processar as informações.");
            }

            return $this->toObject(Array('error' => false, 'info' => $oData));
        } catch (Exception $e) {
            return $this->toObject(Array('error' => true, 'mensagem' => $e->getMessage()));
        }
    }

    public function getDataFromTrash() {
        try {
            $oData = $this->toObject(Array('form' => []));

            $oData->form = $this->produtoModel->listarFromTrash();

            if(!isset($oData)) {
                throw new Exception("Ocorreu um erro ao processar as informações.");
            }

            return $this->toObject(Array('error' => false, 'info' => $oData));
        } catch (Exception $e) {
            return $this->toObject(Array('error' => true, 'mensagem' => $e->getMessage()));
        }
    }

    public function getDataFromLastestProductsSold() {
        try {
            $oData = $this->toObject(Array('form' => []));

            $oData->form = $this->produtoModel->lastestProductsSold();

            if(!isset($oData)) {
                throw new Exception("Ocorreu um erro ao processar as informações.");
            }

            return $this->toObject(Array('error' => false, 'info' => $oData));
        } catch (Exception $e) {
            return $this->toObject(Array('error' => true, 'mensagem' => $e->getMessage()));
        }
    }

    private function trataDataFromLista($oData) {
        //TRANSFORMA A VARIAVEL EM OBJETO
        $oData = $this->toObject($oData);

        //TRATA AS INFORMAÇÕES
        if($oData) {
            foreach ($oData as $x) {
                $x->data_ultima_venda = $x->data_ultima_venda ? date('d-m-Y h:i:s', strtotime($x->data_ultima_venda)) : 'Nenhuma venda foi realizada.';
            }
        }

        return $oData;
    }
}
