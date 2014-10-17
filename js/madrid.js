/**
 * Created by NPR on 8/13/14.
 */
$('.add-to-cart').click(function () {

    var data = {};
    if($(this).attr('id'))
        data = {id:$(this).attr('id')};
    else
        data = $('#productOptionForm').serialize();

    $.ajax({
        url: baseUrl+'madrid/product/addToCart',
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success: function (data) {
            //alert success message
            alert(data.result);
        }
    });
})
;
