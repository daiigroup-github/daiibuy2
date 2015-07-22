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

		$orderArray = Order::model()->findAll("type in (1,2,3) AND supplierId = 5 AND userId = " . Yii::app()->user->id);
		$myfileArray = OrderGroup::model()->findAll("status > 2 AND userId =:userId AND supplierId =:supplierId AND parentId is null AND mainFurnitureId is null ", array(
			":userId"=>isset(Yii::app()->user->id) ? Yii::app()->user->id : 0,
			":supplierId"=>5
		));
		$this->render('index', array(
			'myfileArray'=>$myfileArray,
			'orderArray'=>$orderArray));
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

	public function actionRequestGinzatownSpacialProject()
	{
		$result = array();
		$id = $_POST["orderId"];
		$model = Order::model()->findByPk($id);
		$model->isRequestSpacialProject = 1;
		if($model->save())
		{
			$userSpacialProject = UserSpacialProject::model()->find("orderId = " . $id);
			if(!isset($userSpacialProject))
			{
				$userSpacialProject = new UserSpacialProject();
				$userSpacialProject->userId = Yii::app()->user->id;
				$userSpacialProject->supplierId = $model->supplierId;
				$userSpacialProject->orderId = $id;
				$userSpacialProject->createDateTime = new CDbExpression("NOW()");
			}
			else
			{
				$userSpacialProject->reQuestNo = $userSpacialProject->reQuestNo + 1;
			}
			$userSpacialProject->status = 1;
			$userSpacialProject->updateDateTime = new CDbExpression("NOW()");
			$userSpacialProject->save(false);
			$result["status"] = TRUE;
		}
		else
		{
			$result["status"] = FALSE;
		}

		echo CJSON::encode($result);
	}

	public function actionCreate()
	{
		$this->layout = '//layouts/cl1';
		if(isset($_GET["id"]))
		{
			$model = Order::model()->findByPk($_GET["id"]);
		}
		else
		{
			$model = new Order();
		}

		$this->render('create', array(
			'model'=>$model));
	}

	public function actionFindCategory1()
	{
		if(isset($_POST['brandModelId']))
		{
			$res = '';
			$styles = CategoryToSub::model()->findAll(array(
				'condition'=>'brandModelId=:brandModelId',
				'params'=>array(
					':brandModelId'=>$_POST['brandModelId'],
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก แบบบ้าน --</option>';
			foreach($styles as $style)
			{
				$res .= '<option value="' . $style->category->categoryId . '">' . $style->category->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindCategory2()
	{
		if(isset($_POST['category1Id']))
		{
			$res = '';
			$cat2s = CategoryToSub::model()->findAll(array(
				'condition'=>'categoryId=:categoryId',
				'params'=>array(
					':categoryId'=>$_POST['category1Id'],
				),
//                'order' => 'amphurName'
			));
			$res .= '<option value="">-- เลือก ซีรีย์ --</option>';
			foreach($cat2s as $cat2)
			{
				$res .= '<option value="' . $cat2->subCategory->categoryId . '">' . $cat2->subCategory->title . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindColor()
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
			$res .= '<option value="">-- เลือก สี --</option>';
			if(isset($styles[0]->product->productOptionGroups[0])):
				foreach($styles[0]->product->productOptionGroups[0]->productOptions as $style)
				{
					$res .= '<option value="' . $style->productOptionId . '">' . $style->title . '</option>';
				}
			endif;

			echo $res;
		}
	}

	public function actionSumAllProductByCat2Id()
	{
		$result = array();
		if(isset($_POST["category2Id"]))
		{

			$price = Product::model()->ginzaPriceByCategory1IdAndCategory2Id($_POST['category1Id'], $_POST['category2Id']);
//			$data = Category2ToProduct::model()->findAll('category2Id=:category2Id AND category1Id = :category1Id', array(
//				':category2Id'=>(int) $_POST['category2Id'],
//				':category1Id'=>(int) $_POST["category1Id"]));
			if(isset($price))
			{
				$result["summary"] = $price;
			}
			else
			{
				$result["summary"] = 0;
			}
		}

		echo CJSON::encode($result);
	}

	public function actionPrepareMyfileItem()
	{
//		throw new Exception(print_r($_POST, TRUE));
		$items = array();
		if(isset($_POST) && $_POST != array())
		{
			$i = 1;
			foreach($_POST["OrderItems"]["brandModelId"] as $k=> $v)
			{
				$cat2ToProduct = Category2ToProduct::model()->find("brandModelId = :brandModelId AND category1Id = :category1Id AND category2Id =:category2Id", array(
					":brandModelId"=>$_POST["OrderItems"]["brandModelId"][$k],
					":category1Id"=>$_POST["OrderItems"]["category1Id"][$k],
					":category2Id"=>$_POST["OrderItems"]["category2Id"][$k]));
				if(isset($cat2ToProduct))
				{
					$item["name"] = $_POST["Order"]["title"];
					$item["provinceId"] = $_POST["Order"]["provinceId"];
					$province = Province::model()->findByPk($_POST["Order"]["provinceId"]);
					$item["provinceName"] = $province->provinceName;
					$productOption = ProductOption::model()->findByPk($_POST["OrderItems"]["productOptionId"][$k]);
					$items[$i]["brandModelTitle"] = $cat2ToProduct->brandModel->title;
					$items[$i]["category1Title"] = $cat2ToProduct->category->title;
					$items[$i]["category2Title"] = $cat2ToProduct->category2->title;
					$items[$i]["productOptionTitle"] = isset($productOption) ? $productOption->title : "";
					$items[$i]["price"] = $_POST["OrderItems"]["price"][$k];
					$items[$i]["quantity"] = $_POST["OrderItems"]["quantity"][$k];
					$items[$i]["total"] = $_POST["OrderItems"]["total"][$k];
				}
				$i++;
			}
			echo $this->renderPartial("create_items", array(
				'items'=>$items,
				TRUE,
				TRUE));
		}
	}

	public function actionFinish()
	{
		$result = array();
		$model = $this->saveMyfileGinzaTown($_POST);
		if(isset($model))
		{
			$result["status"] = true;
			$result["orderId"] = $model->orderId;
		}
		else
		{
			$result["status"] = false;
		}

		echo CJSON::encode($result);
	}

	public function actionAddToCart()
	{
		$result = array();
//		$model = $this->saveMyfileGinzaTown($_POST);
		if(isset($_POST["orderId"]) && !empty($_POST["orderId"]))
		{
			$orderId = $_POST["orderId"];
			$model = Order::model()->findByPk($orderId);
			$model->type = 3;
			if($model->save())
			{
				$result["status"] = TRUE;
			}
			else
			{
				$result["status"] = FALSE;
			}
		}
		else
		{
			$result["status"] = FALSE;
		}
		echo CJSON::encode($result);
	}

	public function saveMyfileGinzaTown($datas)
	{
		$orderModel = new Order();
		$orderModel->userId = isset(Yii::app()->user->id) ? Yii::app()->user->id : 0;
		if(isset($datas["Order"]["title"]))
		{
			$orderModel->title = $datas["Order"]["title"];
		}
		$orderModel->supplierId = 5;
		$orderModel->provinceId = $datas["Order"]["provinceId"];
		$orderModel->type = 1;
		$orderModel->status = 2;
		$orderModel->createDateTime = new CDbExpression("NOW()");
		if($orderModel->save())
		{
			$orderId = Yii::app()->db->lastInsertID;
			foreach($datas["OrderItems"]["brandModelId"] as $k=> $v)
			{
				$cat2ToProduct = Category2ToProduct::model()->find("brandModelId = :brandModelId AND category1Id = :category1Id AND category2Id =:category2Id", array(
					":brandModelId"=>$datas["OrderItems"]["brandModelId"][$k],
					":category1Id"=>$datas["OrderItems"]["category1Id"][$k],
					":category2Id"=>$datas["OrderItems"]["category2Id"][$k]));
				if(isset($cat2ToProduct))
				{
					$orderItem = new OrderItems();
					$orderItem->orderId = $orderId;
					$orderItem->productId = $cat2ToProduct->productId;
					$orderItem->title = $cat2ToProduct->product->name;
					$orderItem->createDateTime = new CDbExpression("NOW()");
					$price = Product::model()->ginzaPriceByCategory1IdAndCategory2Id($datas["OrderItems"]["category1Id"][$k], $datas["OrderItems"]["category2Id"][$k]);
					$orderItem->price = $price;
					$orderItem->quantity = $datas["OrderItems"]["quantity"][$k];
					$orderItem->total = $price * $datas["OrderItems"]["quantity"][$k];
					$orderItem->updateDateTime = new CDbExpression("NOW()");

					if($orderItem->save())
					{
						$orderItemId = Yii::app()->db->lastInsertID;
						$productOption = ProductOption::model()->findByPk($datas["OrderItems"]["productOptionId"][$k]);
						$orderItemOption = new OrderItemOption();
						$orderItemOption->orderItemId = $orderItemId;
						$orderItemOption->productOptionGroupId = $productOption->productOptionGroupId;
						$orderItemOption->productOptionId = $productOption->productOptionId;
						if(isset($productOption->pricePercent) && intval($productOption->pricePercent) > 0)
						{
							$orderItemOption->percent = $productOption->pricePercent;
							$orderItemOption->total = $orderItem->total * ($productOption->pricePercent / 100);
						}
						else
						{
							$orderItemOption->percent = 0;
							$orderItemOption->total = 0;
						}
						if(isset($productOption->priceValue) && intval($productOption->priceValue) > 0)
						{
							$orderItemOption->value = $productOption->priceValue;
							$orderItemOption->total = $productOption->priceValue * $orderItem->quantity;
						}
						else
						{
							$orderItemOption->value = 0;
							$orderItemOption->total += 0;
						}
						$orderItemOption->createDateTime = new CDbExpression("NOW()");
						$orderItemOption->updateDateTime = new CDbExpression("NOW()");
						if($orderItemOption->save())
						{

							$orderItem->total += $orderItemOption->total;
							$orderItem->save(FALSE);
						}
						else
						{
							throw new Exception(print_r($orderItemOption->errors, true));
						}
					}
				}
				else
				{
					//Fail
				}
			}
		}

		return $orderModel;
	}

}
