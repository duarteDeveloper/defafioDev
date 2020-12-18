<?php
require_once("C:/xampp/htdocs/avaliacao_dev/model/conexao.php");
class produtoModel {
    CONST STATUS_PRODUCT_ACTIVE = 1;
    CONST STATUS_PRODUCT_REMOVED = 2;


    private $connection;

    public $sql;

    public function __construct(){
        if(!isset($this->connection)) {
            $this->connection = new Conexao('area_central', 'localhost', 'root', '');
            $this->connection->setConexao();
        }
    }

    public function inserir($nome_produto, $valor_produto, $qtd_produto, $codigo_barra) {
        $this->sql = "INSERT INTO z_com_tb_produtos (nome_produto,
                                                     valor_produto,
                                                     qtd_produto,
                                                     codigo_barra)
                                                     VALUES ('$nome_produto',
                                                              $valor_produto,
                                                              $qtd_produto,
                                                              $codigo_barra)";
        return $this->connection->query($this->sql);
    }

    public function editar($id_produto, $nome_produto, $valor_produto, $qtd_produto, $codigo_barra) {
        $this->sql = "UPDATE z_com_tb_produtos SET nome_produto  = '$nome_produto',
                                                   valor_produto = $valor_produto,
                                                   qtd_produto   = $qtd_produto,
                                                   codigo_barra  = $codigo_barra
                                              WHERE id_produto = $id_produto";

        return $this->connection->query($this->sql);
    }

    public function updateToTrash($id_produto) {
        $this->sql = "UPDATE z_com_tb_produtos SET status  = ".self::STATUS_PRODUCT_REMOVED."
                                             WHERE id_produto = $id_produto";

        return $this->connection->query($this->sql);
    }

    public function updateToProductList($id_produto) {
        $this->sql = "UPDATE z_com_tb_produtos SET status  = ".self::STATUS_PRODUCT_ACTIVE."
                                             WHERE id_produto = $id_produto";

        return $this->connection->query($this->sql);
    }

    public function listarFromCounter() {
        $this->connection->query('SELECT count(ztp.id_produto) as total_produto_cadastrado,
                                         count(ztpv.id_produto_vendido) as total_produto_vendido
                                    FROM z_com_tb_produtos ztp
                              LEFT JOIN z_com_tb_produto_vendido as ztpv
                                      ON ztp.id_produto = ztpv.id_produto
                                   WHERE 1=1
                                   AND status = '.self::STATUS_PRODUCT_ACTIVE.'');

        return $this->connection->getObjectResult();
    }

    public function listar() {
        $this->connection->query('SELECT *
                                    FROM z_com_tb_produtos
                                   WHERE 1=1
                                     AND status = '.self::STATUS_PRODUCT_ACTIVE.'');

        return $this->connection->getArrayResults();
    }

    public function listarFromTrash() {
        $this->connection->query('SELECT *
                                    FROM z_com_tb_produtos
                                   WHERE 1=1
                                     AND status = '.self::STATUS_PRODUCT_REMOVED.'');

        return $this->connection->getArrayResults();
    }

    public function getProdutoFromId($id_produto) {
        $this->connection->query('SELECT *
                                    FROM z_com_tb_produtos
                                   WHERE id_produto = '. $id_produto .'');

        return $this->connection->getObjectResult();
    }

    /*
    * SELL PRODUCT SECTION
    */
   public function updateFromSingleValue($id_produto, $valor_produto) {
       $this->sql = "UPDATE z_com_tb_produtos SET valor_produto = $valor_produto
                                             WHERE id_produto  = $id_produto";

       return $this->connection->query($this->sql);
   }

   public function updateProductAfterSellItem($id_produto, $qtd_produto, $valor_total_venda) {
       $this->sql = "UPDATE z_com_tb_produtos SET qtd_produto  = qtd_produto - $qtd_produto,
                                                  data_ultima_venda  = NOW(),
                                                  valor_total_venda  = valor_total_venda + $valor_total_venda
                                             WHERE id_produto  = $id_produto";

       return $this->connection->query($this->sql);
   }

   public function InsertFromSellProduct($id_produto, $valor_produto, $qtd_produto_vendido, $valor_total_venda) {
       $this->sql = "INSERT INTO z_com_tb_produto_vendido (id_produto,
                                                           valor_produto,
                                                           qtd_produto_vendido,
                                                           data_ultima_venda,
                                                           valor_total_venda)
                                                             VALUES ($id_produto,
                                                                    $valor_produto,
                                                                    $qtd_produto_vendido,
                                                                    NOW(),
                                                                    $valor_total_venda)";
       return $this->connection->query($this->sql);
   }

   public function lastestProductsSold() {
       $this->sql = "SELECT ztpv.*, ztp.*
                       FROM z_com_tb_produtos as ztp
                       JOIN z_com_tb_produto_vendido as ztpv
                         ON ztpv.id_produto = ztp.id_produto
                   ORDER BY ztpv.data_ultima_venda ASC
                      LIMIT 20";

        $this->connection->query($this->sql);

        return $this->connection->getArrayResults();
   }

    public function getSql() {
        return $this->sql;
    }

    public function setSql($sql) {
        $this->sql = $sql;
    }
}
