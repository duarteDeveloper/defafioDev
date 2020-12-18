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
                            <h3 class="card-title">Produtos excluídos</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="w-1">#</th>
                                        <th>Descrição</th>
                                        <th>Valor unitário</th>
                                        <th>Estoque</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <?php foreach ($oInfo->getDataFromTrash()->info->form as $key => $value) { ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="text-muted"><?php echo $value->id_produto ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo $value->nome_produto ?></span>
                                        </td>
                                        <td>
                                            <span>R$ <?php echo number_format($value->valor_produto, 2, ',', '.') ?></span>
                                        </td>
                                        <td>
                                            <span ng-bind="x.qtd_produto"><?php echo $value->qtd_produto ?></span>
                                        </td>
                                        <form id="restoreItem_<?php echo $value->id_produto ?>" method="post">
                                            <td>
                                                <a id="restore_item_<?php echo $value->id_produto ?>" class="icon">
                                                    <input type="hidden" name="id_produto" value="<?php echo $value->id_produto ?>"/>
                                                    <i class="fe fe-refresh-ccw"></i>
                                                </a>
                                            </td>
                                        </form>
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
