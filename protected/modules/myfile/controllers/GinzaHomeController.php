<?php

class GinzaHomeController extends MasterMyFileController
{

	const ORDER_PERIOD_1 = 1;
	const ORDER_PERIOD_2 = 2;
	const ORDER_PERIOD_3 = 3;
	const ORDER_PERIOD_4 = 4;
	const ORDER_PERIOD_5 = 5;
	const ORDER_PERIOD_6 = 6;

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = OrderGroup::model()->findAll("status > 2 AND userId =:userId AND supplierId =:supplierId AND parentId is null AND mainFurnitureId is null ", array(
			":userId"=>isset(Yii::app()->user->id) ? Yii::app()->user->id : 0,
			":supplierId"=>4
		));
		$this->render('index', array(
			'myfileArray'=>$myfileArray));
	}

	public function actionView($id)
	{
		$this->layout = '//layouts/cl1';
		Yii::app()->session['supplierId'] = 4;
		$brandModels = BrandModel::model()->findAll("supplierId = 4 AND status = 1");
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
			'price'=>$price,
			'brandModels'=>$brandModels
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
		self::ORDER_PERIOD_4=>"งวดงานก่อสร้างสถาปัตยกรรม<br>ชำระ ณ วันที่ทำสัญญา เพื่อดำเนินการ<br>1.งานติดตั้งโครงหลังคา แล้วเสร็จ<br>2.งานมุงหลังคา + เชิงชาย แล้วเสร็จ<br>3.เดินท่อประปาภายใน และ สุขาภิบาล ภายนอก<br>4.นำวัสดุไฟฟ้าเข้าหน่วยงาน + ร้อยสายไฟในท่อ<br>5.งานปูกระเบื้องพื้น และผนัง(ห้องน้ำ)<br>6.งานปูพื้นชั้น 1 และชั้น 2 <br>7.งานฝ้าภายใน และ งานฝ้าภายนอก<br>8.งานติดตั้งประตูภายนอก<br>9.งานบันไดสำเร็จรูปและราวระเบียงกันตก<br>10.ประตูหน้าต่าง UPVC (ภายนอก)<br>11.งานติดตั้งสุขภัณฑ์<br>12.งานติดตั้งดวงโคมและสวิตท์ปลั๊ก<br>13.งานทาสี",
		self::ORDER_PERIOD_5=>"ส่งมอบงาน",
		self::ORDER_PERIOD_6=>"N/A",
	);

	public function getOrderPeriodText($period)
	{
		return $this->findAllOrderPeriodArray[$period];
	}

	public function actionFindStyle()
	{
		if(isset($_POST['brandModelId']))
		{
			$res = '';
			$styles = ModelToCategory1::model()->findAll(array(
				'condition'=>'brandModelId=:brandModelId',
				'params'=>array(
					':brandModelId'=>$_POST['brandModelId'],
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก Style --</option>';
			foreach($styles as $style)
			{
				$res .= '<option value="' . $style->category->categoryId . '">' . $style->category->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindHouseModel()
	{

		if(isset($_POST['categoryId']))
		{
			$res = '';
			$styles = CategoryToSub::model()->findAll(array(
				'condition'=>'categoryId=:categoryId AND brandModelId = :brandModelId',
				'params'=>array(
					':categoryId'=>$_POST['categoryId'],
					':brandModelId'=>$_POST["brandModelId"]
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก House Model --</option>';
			foreach($styles as $style)
			{
				$res .= '<option value="' . $style->subCategory->categoryId . '">' . $style->subCategory->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindHouseSeries()
	{

		if(isset($_POST['category1Id']))
		{
			$res = '';
			$styles = Category2ToProduct::model()->findAll(array(
				'condition'=>'category1Id=:category1Id AND brandModelId = :brandModelId GROUP BY category2Id',
				'params'=>array(
					':category1Id'=>$_POST['category1Id'],
					':brandModelId'=>$_POST["brandModelId"]
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก House Series --</option>';
			foreach($styles as $style)
			{
				$res .= '<option value="' . $style->category2->categoryId . '">' . $style->category2->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindHouseColor()
	{

		if(isset($_POST['category2Id']))
		{
			$res = '';
			$styles = Category2ToProduct::model()->findAll(array(
				'condition'=>'category1Id=:category1Id AND brandModelId = :brandModelId AND category2Id = :category2Id',
				'params'=>array(
					':category1Id'=>$_POST['category1Id'],
					':category2Id'=>$_POST['category2Id'],
					':brandModelId'=>$_POST["brandModelId"]
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก House Color --</option>';
			foreach($styles[0]->product->productOptionGroups[0]->productOptions as $style)
			{
				$res .= '<option value="' . $style->productOptionId . '">' . $style->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFurniture($id)
	{
		$this->layout = '//layouts/cl1';
		$model = OrderGroup::model()->findByPk($id);
		$cat2ToProduct = $model->orders[0]->orderItems[0]->product->category2ToProducts[0];
		$furnitureGroups = FurnitureGroup::model()->findAll("categoryId = $cat2ToProduct->category1Id AND category2Id = $cat2ToProduct->category2Id");
		$this->render(
			'_furniture', array(
			'model'=>$model,
			'furnitureGroups'=>$furnitureGroups
			)
		);
	}

	public function actionFurnitureColor()
	{
		$furnitureGroup = FurnitureGroup::model()->findByPk($_POST["furnitureGroupId"]);
		if(isset($_POST["orderGroupId"]) && !empty($_POST["orderGroupId"]))
		{
			$model = OrderGroup::model()->findByPk($_POST["orderGroupId"]);
		}

		echo $this->renderPartial("_furniture_color", array(
			'furnitures'=>$furnitureGroup->furnitures,
			'model'=>$model), true);
	}

	public function actionFurnitureItem()
	{
		$furniture = Furniture::model()->findByPk($_POST["furnitureId"]);

		echo $this->renderPartial("_furniture_item", array(
			'furniture'=>$furniture), true);
	}

	public function actionFurnitureItemSub()
	{
		$result = array();
		$furnitureItem = FurnitureItem::model()->findByPk($_POST["furnitureItemId"]);
		if(isset($furnitureItem))
		{
			$result["status"] = TRUE;
			$result["furnitureItemSub"] = $this->renderPartial("_furniture_item_sub", array(
				'furnitureItem'=>$furnitureItem), true);
			$result['planName'] = $furnitureItem->title;
			$result['planImage'] = CHtml::image(Yii::app()->baseUrl . $furnitureItem->plan, '', array(
					'style'=>'width:100%'));
		}
		else
		{
			$result["status"] = FALSE;
		}

		echo CJSON::encode($result);
	}

	public function actionRenderCondition()
	{
		$model = OrderGroup::model()->findByPk($_POST["orderGroupId"]);
		$child1 = $model->child;
		$conditionOrder = null;
		switch($_POST["period"])
		{
			case 2:
				$conditionOrder = $model;
				break;
			case 3:
				$conditionOrder = $child1;
				break;
			case 4:
				$conditionOrder = $child1->child;
				break;
		}
		$brandModels = BrandModel::model()->findAll("supplierId = 4 AND status = 1");
		echo $this->renderPartial("_condition", array(
			'model'=>$model,
			'period'=>$_POST["period"],
			'brandModels'=>$brandModels,
			'child1'=>$child1,
			'conditionOrder'=>$conditionOrder), true);
	}

}
