/**
 *
 * Created by NPR on 8/13/14.
 */

$('.addToCart').live('click', function () {
	var productId = $(this).data('productid');
//        alert($("#c1400").val());

	var qty = $("#"+productId).val();
        var color = $("#c"+productId).val();
	var data = {productId: productId, qty: qty, color: color};
        alert(color);

//	alert($(this).data('productid'));

	$.ajax({
		url: baseUrl + '/atechwindow/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		beforeSend: function () {
			return confirm('คุณต้องการเพิ่มสินค้าลงตะตร้าหรือไม่ ?')
		},
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
