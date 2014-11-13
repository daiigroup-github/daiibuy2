<?php

class CartController extends MasterController
{

	public function actionAddToCart()
	{
		$res = array();

		$res['result'] = 'success' . print_r($_POST, true);

		echo CJSON::encode($res);
	}

	public function actionUpdateCartHeader()
	{
		$res = array();
		$cartHeaderTable = '';
		$i = 0;

		foreach(Supplier::model()->findAll() as $supplier)
		{
			$orderSummary = array();
			$orderSummary = Order::model()->sumOrderTotalBySupplierId($supplier->supplierId);

			if(intval($orderSummary['total']) == 0)
			{
				continue;
			}

			/*
			  <tr>
			  <td><img src="<?php echo Yii::app()->baseUrl . '/images/supplier/ginzahome.jpg' ?>" alt="product"></td>
			  <td>
			  <h6>Ginza Home</h6>
			  </td>
			  <td>
			  <span class="quantity"><span class="light">1 x</span> 9,120,000.00 บาท</span>
			  <a href="<?php echo Yii::app()->createUrl("/checkout/cart/index/id/4") ?>" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart"></i> View</a>
			  <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> </a>
			  </td>
			  </tr>
			 */

			$cartHeaderTable .= '<tr>' .
				'<td>' . CHtml::image(Yii::app()->baseUrl . $supplier->logo) . '</td>' .
				'<td>' . $supplier->name . '</td>' .
				'<td>' .
				'<span class="quantity">' . $orderSummary['grandTotal'] . ' บาท</span>' .
				CHtml::link('<i class="fa fa-shopping-cart"></i> View Cart', Yii::app()->createUrl("/checkout/cart/index/id/" . $supplier->supplierId), array(
					'class'=>'btn btn-info btn-xs')) .
//				CHtml::link('<i class="fa fa-ban"></i>', '', array(
//					'class'=>'btn btn-danger btn-xs')) .
				'</td>' .
				'</tr>';

			$i++;
		}

		$res['cartHeaderTable'] = $cartHeaderTable;
		$res['cartHeader'] = $i . ' Suppliers';

		echo CJSON::encode($res);
	}

}
