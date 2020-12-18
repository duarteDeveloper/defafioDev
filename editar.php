<?php require_once("./controller/produtoController.php");?>
<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>
<body>
    <?php include("topo.php") ?>
    <!-- INSTANCIA A CLASSE DO PRODUTO  -->
    <?php
        $oInfo = new produtoController();

        $oProduto = $oInfo->getDataEdit($_GET['id_produto'])->info->form;
    ?>
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="editProduct" class="card" method="POST">
                        <div class="card-body">
                            <h3 class="card-title">Editar produto - <?php echo ucfirst($oProduto->nome_produto) ?></h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Descrição</label>
                                        <input type="text" class="form-control" name="nome_produto" placeholder="Arroz.." value="<?php echo ucfirst($oProduto->nome_produto) ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Estoque</label>
                                        <input type="number" class="form-control" name="qtd_produto" placeholder="10.." value="<?php echo ucfirst($oProduto->qtd_produto) ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Código de barras</label>
                                        <input type="number" class="form-control" name="codigo_barra" placeholder="78978978978978" value="<?php echo $oProduto->codigo_barra ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Valor unitário</label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">R$</span>
                                            </span>
                                            <input id="valor_produto" type="text" class="form-control text-right" name="valor_produto" placeholder="0,00" aria-label="Valor" value="<?php echo $oProduto->valor_produto ?>">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_produto" name="id_produto" value="<?php echo $_GET['id_produto']?>"/>
                            </div>
                        </div>
                        <div class="card-footer text-left" style="display: flex; justify-content: space-between">
                            <div>
                                <a href="./produto.php" class="btn btn-secondary">Voltar para produtos</a>
                            </div>
                            <div>
                                <button id="post_edit_product" type="button" class="btn btn-primary">Confirmar alteração</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("scripts.php") ?>
</body>
</html>
