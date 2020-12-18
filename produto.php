<?php require_once("./controller/produtoController.php");?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include("head.php"); ?>
<body>
    <?php include("topo.php"); ?>
    <!-- INSTANCIA A CLASSE DO PRODUTO  -->
    <?php
        $oInfo = new produtoController();
    ?>
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row row-cards row-deck">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Produtos</h3>
                            <div class="card-options">
                                <a href="./addproduto.php" class="btn btn-azure">Adicionar</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="w-1">#</th>
                                        <th>Descrição</th>
                                        <th>Valor unitário</th>
                                        <th>Estoque</th>
                                        <th>Data última venda</th>
                                        <th>Total de vendas</th>
                                        <th class="w-1"></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($oInfo->getData()->info->form as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <span class="text-muted"><?php echo $value->id_produto ?></span></td>
                                                <td>
                                                    <span> <?php echo ucfirst($value->nome_produto) ?></span>
                                                </td>
                                                <td>
                                                    <span>R$ <?php echo number_format($value->valor_produto, 2, ',', '.') ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo $value->qtd_produto ?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo $value->data_ultima_venda ?></span>
                                                </td>
                                                <td>
                                                    <span>R$ <?php echo $value->valor_total_venda ?></span>
                                                </td>
                                                <td>
                                                    <a class="icon" href="editar.php?id_produto=<?php echo $value->id_produto ?>">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form id="removeItem_<?php echo $value->id_produto ?>" method="post">
                                                        <a id="remove_item_<?php echo $value->id_produto ?>" class="icon">
                                                            <input type="hidden" name="id_produto" value="<?php echo $value->id_produto ?>"/>
                                                            <i class="fe fe-trash"></i>
                                                        </a>
                                                    </form>
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
        <?php include("scripts.php"); ?>
    </body>
    </html>
