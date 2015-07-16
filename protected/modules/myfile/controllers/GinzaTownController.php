<?php

class GinzaTownController extends MasterMyFileController
{

	const ORDER_PERIOD_1 = 1;
	const ORDER_PERIOD_2 = 2;
	const ORDER_PERIOD_3 = 3;
	const ORDER_PERIOD_4 = 4;

//	const ORDER_PERIOD_5 = 5;
	public function init()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ginzatown.js');
		parent::init();
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = OrderGroup::model()->findAll("status > 2 AND userId =:userId AND supplierId =:supplierId AND parentId is null AND mainFurnitureId is null ", array(
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
		$brandModelArray = BrandModel::model()->findAllBrandModelArrayBySupplierId(5);
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
			'brandModelArray'=>$brandModelArray,
			'errorMessage'=>isset($_GET["errorMessage"]) ? $_GET["errorMessage"] : NULL
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

	public function actionFindHouseModel()
	{

		if(isset($_POST['brandModelId']))
		{
			$res = '';
			$styles = CategoryToSub::model()->findAll(array(
				'condition'=>'brandModelId = :brandModelId',
				'params'=>array(
					':brandModelId'=>$_POST["brandModelId"]
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก House Model --</option>';
			foreach($styles as $style)
			{
				$res .= '<option value="' . $style->categoryId . '">' . $style->category->title . '</option>';
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
		$brandModels = BrandModel::model()->findAllBrandModelArrayBySupplierId(5);
		echo $this->renderPartial("_condition", array(
			'model'=>$model,
			'period'=>$_POST["period"],
			'brandModels'=>$brandModels,
			'child1'=>$child1,
			'conditionOrder'=>$conditionOrder), true);
	}

	public function actionRequestGinzatownSpacialProject($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$model->isRequestSpacialProject = 1;
		if($model->save())
		{
			$userSpacialProject = UserSpacialProject::model()->find("orderId = " . $id);
			if(!isset($userSpacialProject))
			{
				$userSpacialProject = new UserSpacialProject();
				$userSpacialProject->userId = Yii::app()->user->id;
				$userSpacialProject->supplierId = $model->supplierId;
				$userSpacialProject->orderGroupId = $id;
				$userSpacialProject->createDateTime = new CDbExpression("NOW()");
			}
			else
			{
				$userSpacialProject->reQuestNo = $userSpacialProject->reQuestNo + 1;
			}
			$userSpacialProject->status = 1;
			$userSpacialProject->updateDateTime = new CDbExpression("NOW()");
			$userSpacialProject->save(false);
		}
		$this->redirect(array(
			'view',
			'id'=>$id));
	}

}
