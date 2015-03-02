<?php

class GinzaTownController extends MasterMyFileController
{

	const ORDER_PERIOD_1 = 1;
	const ORDER_PERIOD_2 = 2;
	const ORDER_PERIOD_3 = 3;
	const ORDER_PERIOD_4 = 4;
//	const ORDER_PERIOD_5 = 5;

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = OrderGroup::model()->findAll("status > 2 AND userId =:userId AND supplierId =:supplierId AND parentId is null ", array(
			":userId"=>isset(Yii::app()->user->id) ? Yii::app()->user->id : 0,
			":supplierId"=>5
		));
		$this->render('index', array(
			'myfileArray'=>$myfileArray));
	}

	public function actionView($id)
	{
		$this->layout = '//layouts/cl1';
		Yii::app()->session['supplierId'] = 5;
		$model = OrderGroup::model()->findByPk($id);
		$productId = $model->orders[0]->orderItems[0]->productId;
		if(isset($model->child))
		{
			$child1 = $model->child;
			$productId .="," . $child1->orders[0]->orderItems[0]->productId;
			if($child1->child)
			{
				$child2 = $child1->child;
				$productId .="," . $child2->orders[0]->orderItems[0]->productId;
				if($child2->child)
				{
					$child3 = $child2->child;
					$productId .="," . $child3->orders[0]->orderItems[0]->productId;
				}
			}
		}

		$cat2ToProduct = Category2ToProduct::model()->find("productId = :productId", array(
			":productId"=>$model->orders[0]->orderItems[0]->productId));
		$cat2ToProducts = Category2ToProduct::model()->findAll("category1Id = :catgory1Id AND category2Id=:category2Id", array(
			":catgory1Id"=>$cat2ToProduct->category1Id,
			':category2Id'=>$cat2ToProduct->category2Id));
		$productWithOutPay = Category2ToProduct::model()->findAll("category1Id=:category1Id AND category2Id=:category2Id AND productId not in(" . $productId . ") ORDER BY sortOrder ASC", array(
			":category2Id"=>$cat2ToProduct->category2Id,
			":category1Id"=>$cat2ToProduct->category1Id,
		));

		$price = 0;
		$i = 0;
		foreach($cat2ToProducts as $cat2ToProduct)
		{
			$price += ($cat2ToProduct->product->calProductPromotionPrice() > 0) ? $cat2ToProduct->product->calProductPromotionPrice() : $cat2ToProduct->product->calProductPrice();

			if($i == 0)
			{
				$bookingPrice = $price;
				$description = $cat2ToProduct->product->description;
				$productSortOrder1 = $cat2ToProduct->product;
			}
			$i++;
		}
		$this->render('view', array(
			'model'=>$model,
			'productWithOutPay'=>$productWithOutPay,
			'cat2ToProduct'=>$cat2ToProduct,
			'price'=>$price
		));
	}

	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public $findAllOrderPeriodArray = array(
		self::ORDER_PERIOD_1=>"งานสำรวจ",
		self::ORDER_PERIOD_2=>"งวดงานเข็ม<br>ชำระ ณ วันที่ทำสัญญา เพื่อดำเนินการ<br>เตรียมงานและขออนุญาติทำการก่อสร้าง<br>1.งานยื่นอนุญาติ<br>2.ตอกเข็มเสร็จแล้ว",
		self::ORDER_PERIOD_3=>"งวดงานก่อสร้างโครงสร้าง<br>ชำระ ณ วันที่ทำสัญญา เพื่อดำเนินการ <br>เตรียมงานและขออนุญาติทำการก่อสร้าง<br>1.งานฐานรากอาคารเสร็จแล้ว<br>2.งานติดตั้งโครงสร้างผนังสำเร็จรูป 1-2 แล้วเสร็จ <br>3.งานจำกัดปลวกแล้วเสร็จ<br>4.งานติดตั้งพื้นสำเร็จรูปชั้น 1-2 พร้อมเท Topping<br>5.งานพื้นห้องน้ำพร้อมวาง Sleeve<br>6.งานซักล้าง + เทพื้นโรงจอดรถ",
		self::ORDER_PERIOD_4=>"ส่งมอบงาน",
	);

	public function getOrderPeriodText($period)
	{
		return $this->findAllOrderPeriodArray[$period];
	}

}
