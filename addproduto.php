<?php require_once("./controller/produtoController.php");?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>
<body>
    <?php include("topo.php"); ?>
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="addProduct" class="card" method="POST">
                        <div class="card-body">
                            <h3 class="card-title">Novo produto</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Descrição</label>
                                        <input type="text" class="form-control" placeholder="Arroz.." name="nome_produto">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Estoque</label>
                                        <input type="number" class="form-control" placeholder="10.." name="qtd_produto">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Código de barras</label>
                                        <input type="number" class="form-control" placeholder="78978978978978" name="codigo_barra">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Valor unitário</label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">R$</span>
                                            </span>
                                            <input id="valor_produto" type="text" class="form-control text-right" placeholder="R$ 0,00" aria-label="Valor" name="valor_produto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left" style="display: flex; justify-content: space-between">
                            <div>
                                <a href="./produto.php" class="btn btn-secondary">Voltar para produtos</a>
                            </div>
                            <div>
                                <button id="post_add_product" type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("scripts.php"); ?>
</body>
</html>
