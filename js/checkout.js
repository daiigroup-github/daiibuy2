/**
 * Created by NPR on 10/22/14.
 */

function checkAcceptAgreement()
{
	var myRadio = $("input:radio[name=paymentMethod]:checked").val();
	if (myRadio != null)
	{
		if ($("#accept").prop('checked'))
		{
			return true;
		}
		else
		{
			alert("กรุณาอ่านและ ยอมรับเงื่อนไข ของ Daiibuy");
			return false;
		}
	}
	else
	{
		alert("กรุณาเลือกช่องทางการชำระเงิน");
		return false;
	}

}
$('#readTermCondition').live('click', function () {
	$('#termAndConditionModal').modal({
		backdrop: 'static',
		keyboard: false,
		show: true
	});
});
$('#acceptModal').live('click', function () {
	$("#accept").prop('checked', true);
});
function ChkRadioBillAddress(value, sel)
{
	var check;
	if (value == 1)
	{
//		var attrName = sel.attributes['name'].value;
//		var obj = $('select[name=\"' + attrName + '\"]');
//		var addressId = obj.val();
//		if (addressId == null)
//		{
//			check = false;
//		}
//		else
//		{
//			check = true;
//		}
		check = true;

	}
	else
	{
		check = true;
	}
	$("input:radio[name=billingRadio][value=" + value + "]").attr('checked', check);
}

function ChkRadioShipAddress(value, sel)
{
	var check;
	if (value == 1)
	{
//		var attrName = sel.attr['name'].value;
//		var obj = $('select[name=\"' + attrName + '\"]');
//		var addressId = obj.val();
//		if (addressId == null)
//		{
//			check = false;
//		}
//		else
//		{
//			check = true;
//		}
		check = true;

	}
	else
	{
		check = true;
	}
	$("input:radio[name=shippingRadio][value=" + value + "]").attr('checked', check);
}