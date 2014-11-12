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
		url: baseUrl + '/atechwindow/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function (data) {
			//alert success message
			if (data.result)
			{
				updateCartHeader();
				alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียนร้อยแล้ว");
			}
			else
			{
				alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
			}
		}
	});
});
