<?php require_once("./controller/produtoController.php");?>
<?php $oInfo = new produtoController(); ?>

<script src="Assets/js/vendors/jquery-3.2.1.min.js"></script>
<!-- Input Mask Plugin -->
<script src="Assets/plugins/input-mask/js/jquery.mask.min.js"></script>
<!-- c3.js Charts Plugin -->
<script src="Assets/js/custom.js?<?php $num = range(1, 9); shuffle($num); foreach($num as $x) { echo $x;} ?>"></script>

<script>
/**
* PUSH AJAX VIA POST
*/


var form = {
    edit_product: $('#editProduct'),
    add_product: $('#addProduct'),
    sell_product: $('#sellProduct')
};


$('#post_edit_product').click(function() {
    $.ajax({
        url: './tratamentos/http_edit_product_post.php',
        type: 'POST',
        data: form.edit_product.serialize()
    }).done(function(data){
        data = JSON.parse(data);
        afterPush(data);
    });
});

$('#post_add_product').click(function() {
    $.ajax({
        url: './tratamentos/http_add_product_post.php',
        type: 'POST',
        data: form.add_product.serialize()
    }).done(function(data){
        data = JSON.parse(data);
        afterPush(data);
    });
});

$('#sell_product').click(function() {
    $.ajax({
        url: './tratamentos/http_sell_product_post.php',
        type: 'POST',
        data: form.sell_product.serialize()
    }).done(function(data){
        data = JSON.parse(data);
        afterPush(data);
    });
});

<?php foreach ($oInfo->getData()->info->form as $x => $y) { ?>

    var form_remove_item_<?php echo $y->id_produto ?> = $('#removeItem_<?php echo $y->id_produto?>');

    $('#remove_item_<?php echo $y->id_produto ?>').click(function() {
        $.ajax({
            url: './tratamentos/http_remove_product_post.php',
            type: 'POST',
            data: form_remove_item_<?php echo $y->id_produto ?>.serialize()
        }).done(function(data){
            data = JSON.parse(data);
            afterPush(data);
        });
    });
    <?php } ?>

<?php foreach ($oInfo->getDataFromTrash()->info->form as $k => $v) { ?>

    var form_restore_item_<?php echo $v->id_produto ?> = $('#restoreItem_<?php echo $v->id_produto ?>');

    $('#restore_item_<?php echo $v->id_produto ?>').click(function() {
        $.ajax({
            url: './tratamentos/http_restore_product_post.php',
            type: 'POST',
            data: form_restore_item_<?php echo $v->id_produto ?>.serialize()
        }).done(function(data){
            data = JSON.parse(data);
            afterPush(data);
        });
    });
    <?php }?>

afterPush = function(data) {
    if(data.error) {
        alert(data.mensagem);
        return false;
    }

    if(!data.error) {
        alert(data.mensagem);
        window.location.reload(true);
    }
}

</script>
