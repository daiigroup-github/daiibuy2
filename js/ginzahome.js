/**
 * Created by NPR on 8/13/14.
 */

$('#addToCartGinzaHome').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + 'ginzahome/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
			success: function (data) {
				//alert success message
				alert(data.result);
			}
		});
	}
});
function payClick(peroid)
{
	$("#condition" + peroid + "Modal").modal("show");
}
