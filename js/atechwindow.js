/**
 *
 * Created by NPR on 8/13/14.
 */

$('.addToCart').live('click', function () {
	var productId = $(this).data('productid');
//        alert($("#c2322").val());

	var qty = $("#"+productId).val();
        var color = $("#c"+productId).data('productoptionid');
	var data = {productId: productId, qty: qty, color: color};
//        alert(color);

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
                                changeColorButton(productId);
				alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียบร้อยแล้ว");
			}
			else
			{
				alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
			}
		}
	});
});

function changeColorButton(productId){
    $('#b'+productId).removeClass("btn-primary").addClass("btn-danger");
}

function checkComment()
{
	if ($("#OrderDetailValue_4_value").val() == "")
	{
		alert("กรุณากรอกคำร้อง");
		return false;
	}
	else
	{
            $('#Order_createMyfileType').val(2);
		return true;
	}
}
