/**
 *
 * Created by NPR on 8/13/14.
 */

$('.addToCart').live('click', function () {

	var productId = $(this).data('productid');
	var qty = $('#' + productId).val();
	var data = {productId: productId, qty: qty};

//	alert($(this).data('productid'));

	$.ajax({
		url: baseUrl + 'atechwindow/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function (data) {
			//alert success message
			alert("เพิ่มสินค้าลงตระกร้าสำเร็จ");
		}
	});
});
