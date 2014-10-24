/**
 * Created by NPR on 8/13/14.
 */
var baseUrl = (window.location.host === 'dev') ? 'http://dev/daiibuy2/' : window.location.origin + '/daiibuy2/';

/**
 * Fenzer Category
 */
$('.removeProductItem').live('click', function () {
	if (confirm('Remove This Item'))
		$(this).parent().parent().fadeOut(500, function () {
			$(this).remove();
		});
});

$('#addToCartFenzer').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + 'fenzer/product/addToCart',
			dataType: 'json',
			data: $('#productItemsForm').serialize(),
			success: function (data) {
				//alert success message
				alert(data.result);
			}
		});
	}
});

/**
 * only number can press in input type number
 */
$(document).ready(function () {
	$('input[type=number]').live('keypress', function (evt) {
		if (evt.which < 48 || evt.which > 57)
		{
			evt.preventDefault();
			return false;
		}
	});
});

