$(document).ready(function() {
    /**
    * TRANSIÇÂO DE CLASS MENU ACTIVE "TEORICAMENTE" DINÂMICA
    */

    switch (window.location.pathname) {
        case '/avaliacao_dev/':
            $('.nav-link').eq(1).addClass('active');
            break;
        case '/avaliacao_dev/addproduto.php':
        case '/avaliacao_dev/produto.php':
        case '/avaliacao_dev/editar.php':
            $('.nav-link').eq(2).addClass('active');
            break;
        case '/avaliacao_dev/venda.php':
            $('.nav-link').eq(3).addClass('active');
            break;
        case '/avaliacao_dev/produtoexcluido.php':
            $('.nav-link').eq(4).addClass('active');
            break;
    }

    $('[name="qtd_produto"], [name="valor_produto"]').keyup(function(){
        setTimeout(function(){
            var x = parseFloat($('[name="valor_total_produto"]').val());

            x = $('[name="valor_produto"]').val() * $('[name="qtd_produto"]').val();

            var y = $('[name="valor_total_produto"]').val(x.toFixed(2));

            return y;

        }, 1500);
    });


    /**
     * INPUT MASK
     */
     $("#valor_produto").mask('000.000.000.000.00', {reverse: true});
     $('[name="valor_total_produto"]').mask('000.000.000.000.00', {reverse: true});

});
