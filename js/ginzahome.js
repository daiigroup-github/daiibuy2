/**
 * Created by NPR on 8/13/14.
 */

$('#addToCartGinzaHome').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + '/ginzahome/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
			success: function (data) {
				//alert success message
				if (data.result)
				{
					updateCartHeader();
					alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียนร้อยแล้ว");
				}
				else
				{
					if (data.errorMessage != "")
					{
						alert(data.errorMessage);
					}
					else
					{
						alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
					}
				}
			}
		});
	}
});
function payClick(peroid)
{
	$("#condition" + peroid + "Modal").modal("show");
}
