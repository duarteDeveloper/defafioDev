<?php require_once("./controller/homeController.php");?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>
<!-- INSTANCIA A CLASSE DO PRODUTO  -->
<?php
    $oInfo = new homeController();
?>
<body>
    <?php include("topo.php") ?>;
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    Home
                </h1>
            </div>
            <div class="row row-cards">
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 m-0"><?php echo  $oInfo->getData()->info->form->total_produto_cadastrado ?></div>
                            <div class="text-muted mb-4">Produtos</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 m-0"><?php echo  $oInfo->getData()->info->form->total_produto_vendido ?></div>
                            <div class="text-muted mb-4">Venda</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("scripts.php"); ?>
</body>
</html>
