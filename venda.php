<?php require_once("./controller/produtoController.php");?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>
<body>
    <?php include("topo.php") ?>
    <!-- INSTANCIA A CLASSE DO PRODUTO  -->
    <?php
        $oInfo = new produtoController();
    ?>
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="sellProduct" class="card" method="POST">
                        <div class="card-body">
                            <h3 class="card-title">Realizar venda de um produto</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Produto</label>
                                        <select name="id_produto" class="form-control custom-select">
                                            <option value="">Selecione um Produto</option>
                                            <?php foreach ($oInfo->getData()->info->form as $key => $value) { ?>
                                             <option value="<?php echo $value->id_produto ?>"><?php echo $value->nome_produto ?></option>
                                         <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Quantidade</label>
                                        <input type="number" class="form-control" placeholder="Digite aqui a quantidade" name="qtd_produto">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Valor unitário</label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">R$</span>
                                            </span>
                                            <input id="valor_produto" type="text" class="form-control text-right" aria-label="Valor" name="valor_produto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Valor total</label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">R$</span>
                                            </span>
                                            <input id="valor_produto" type="text" name="valor_total_produto" class="form-control text-right" aria-label="Valor" disabled="disabled" title="Este campo não pode ser alterado" placeholder="R$ 0,00">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="form-group">
                                        <div class="form-label">&nbsp;</div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="checker_update">
                                                <span class="custom-control-label">Atualizar valor unitário do produto</span>
                                            </label>
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
                                <button id="sell_product" type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row row-cards row-deck">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimas vendas realizadas</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="w-1">#</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor unitário</th>
                                        <th>Valor total da venda</th>
                                    </tr>
                                </thead>
                                <?php foreach ($oInfo->getDataFromLastestProductsSold()->info->form as $key => $x) { ?>
                                <tbody>
                                    <tr>
                                        <td><span class="text-muted"><?php echo $x->id_produto; ?></span></td>
                                        <td><?php echo $x->nome_produto; ?></td>
                                        <td>
                                            <?php echo $x->qtd_produto_vendido; ?>
                                        </td>
                                        <td>
                                            R$ <?php echo number_format($x->valor_produto, 2, '.', ','); ?>
                                        </td>
                                        <td>
                                            R$ <?php echo number_format($x->valor_total_venda, 2, '.', ','); ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("scripts.php") ?>
</body>
