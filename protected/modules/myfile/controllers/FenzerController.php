<?php

class FenzerController extends MasterMyFileController
{

    public function init()
    {

        parent::init();
    }

    public function actionIndex()
    {
        $this->layout = '//layouts/cl1';

        $myfileArray = Order::model()->findAllMyFileBySupplierId(Yii::app()->user->id, 1, null);
        $myfileHistoryArray = Order::model()->findAllMyFileHistoryBySupplierId(Yii::app()->user->id, 1, null);
        $this->render('index', array(
            'myfileArray' => $myfileArray,
            'myfileHistoryArray' => $myfileHistoryArray));
    }

    public function actionCreate()
    {
        $this->layout = '//layouts/cl1';

        $model = new Order;
        $orderDetailModel = new OrderDetail;
        $orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(1);
        $orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
        foreach ($orderDetailTemplateField as $field) {
            $heightField = $field;
        }
        $heightArray = array(
            '0.60-1.39' => '0.60-1.39',
            '1.40-1.60' => '1.40-1.60',
            '1.61-1.80' => '1.61-1.80',
            '1.81-2.00' => '1.81-2.00',
            '2.01-2.40' => '2.01-2.40',
            '2.41-2.60' => '2.41-2.60',
            '2.61-2.80' => '2.61-2.80',
            '2.81-3.00' => '2.81-3.00');

        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='order-create-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $orderModel->type = 1;
            $orderModel->status = 1;

            if ($model->save()) {
                $this->redirect(array(
                    'index'
                ));
            }
        } else {
            $this->render('create', array(
                'model' => $model,
                'orderDetailModel' => $orderDetailModel,
                'orderDetailTemplateFieldArray' => $orderDetailTemplateField,
                'heightArray' => $heightArray,
            ));
        }
    }

    public function actionShowFenzerProductResultByHeight()
    {
//		if(isset($value))
//		{
        $status = 1;

//			$brandModel = BrandModel::model()->find('supplierId = 1 AND status = 1');
//			$cate1Model = $brandModel->with('categorys')->findAll(
//				array('condition'=>'categorys.isRoot = 1 AND categorys.status = 1'
//					));
//			$categoryModel = Category::model()->findByPk($categoryId);
        if (isset($_POST['height'])) {

            $value = $_POST['height'];
            $height = explode("-", $value);
            $cate1 = Category::model()->findAll('supplierId = 1 and status = 1 and isRoot = 1');
            $productResult = array();
            $i = 0;
            foreach ($cate1 as $cat) {
                foreach ($cat->subCategorys as $cat2) {
                    if (($cat2->description >= $height[0]) and ( $cat2->description <= $height[1])) {
                        $productResult[$i]['cat1'] = $cat;
                        $productResult[$i]['title'] = $cat2->title;
                        $productResult[$i]['categoryId'] = $cat2->categoryId;
                        $productResult[$i]['description'] = $cat2->description;
                        $i++;
                    }
                }
            }

//		$productResult = Category::model()->with('subCategorys')->findAll(
//			array(
//				'condition'=>'subCategorys.status = 1 AND subCategorys.supplierId = 1  AND isRoot = 0 AND '
//				. '(subCategorys.description >= :minHeight AND subCategorys.description <= :maxHeight)',
//				'params'=>array(
//					':minHeight'=>$height[0],
//					':maxHeight'=>$height[1])
//		));
//			$cate2Model = $cate1Model->with('subCategorys')->findAll(
//				array('condition'=>'subCategorys.status = 1 AND '
//					. '(subCategorys.description > :minHeight AND subCategorys.description < :maxHeight)',
//					'params'=>array(':minHeight'=>$height[0],
//						':maxHeight'=>$height[1])
//					));
//		$productResult = Category::model()->findAll('supplierId = 1 AND status = 1 AND (description >= ' . $height[0] . ' AND description <= ' . $height[1] . ')');
//		throw new Exception(print_r($productResult,true));
//            throw new Exception(print_r($productResult, true));
            echo $this->renderPartial('/fenzer/_product_result', array(
                'productResult' => $productResult), TRUE, TRUE);
//
        } else {
            //throw new Exception();
            echo "<div class='text-center'>ไม่ค้นพบสินค้า.</div>";
        }
//		}
    }

    public function actionShowProductSelected()
    {
//		throw new Exception(print_r($_REQUEST, true));

        if (isset($_POST['categoryId'])) {
            $categoryId = $_POST['categoryId'];
        }
        if (isset($categoryId)) {
            $res = Category::model()->findByPk($categoryId);
            $planImage = $res->image;
            $image = $res->image;
            echo $this->renderPartial('/fenzer/_product_result_selected', array(
                'productResultSelected' => $res,
                'planImage' => $planImage,
                'image' => $image), TRUE, TRUE);
        }
    }

    public function actionShowProductOrder()
    {
        $orderModel = new Order();
        $orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
        if (isset($_POST['Order'])) {
            $provinceId = $_POST['Order']['provinceId'];
            $title = $_POST['Order']['title'];
        }
        $categoryId = $_POST['categoryId'];
        $cat1Id = $_POST['cat1Id'];
        if (isset($_POST['height'])) {
            $value = $_POST['height'];
            $height = explode("-", $value);
        }
        if (isset($_POST['length']) && !empty($_POST['length'])) {
            $length = $_POST['length'];
        }
//		$cate2 = $categoryModel->with('subCategorys')->findAll(
//				array('condition'=>'subCategorys.status = 1 AND '
//					. '(subCategorys.description > :minHeight AND subCategorys.description < :maxHeight)',
//					'params'=>array(':minHeight'=>$height[0],
//						':maxHeight'=>$height[1])
//					));
//		$productCate2 = $cate2[0]->subCategorys[0];

        if (!isset($length)) {
            $length = 0;
        }
        $itemSetArray = Product::model()->calculateItemSetFenzer($cat1Id, $categoryId, $length, $provinceId);
//		throw new Exception(print_r($itemSetArray,true));
        echo $this->renderPartial('/fenzer/_edit_product_result', array(
            'productResult' => $itemSetArray,
        ), TRUE, TRUE);
    }

    public function actionAddNewProductItem()
    {
        if (isset($_POST['Order'])) {
            $provinceId = $_POST['Order']['provinceId'];
            $title = $_POST['Order']['title'];
        }
        if (isset($_POST['productId']) && !empty($_POST['productId'])) {
            $productId = $_POST['productId'];
        }
        $itemSetArray = Product::model()->calculateNewItemFenzer($productId, $provinceId);
        echo '<tr id="' . $itemSetArray['item']['productId'] . '">'
        . '<td>' . $itemSetArray['item']['code'] . '</td>'
        . '<td>' . $itemSetArray['item']['name'] . '</td>'
        . '<td>' . $itemSetArray['item']['productUnits'] . '</td>'
        . '<td>' . CHtml::textField('productItems[' . $itemSetArray['item']['productId'] . '][quantity]', $itemSetArray['item']['quantity'], array(
            'class' => 'edit-table-qty-input')) . '</td>'
        . '<td>' . $this->formatMoney($itemSetArray['item']['price'] / $itemSetArray['item']['quantity'], true) . '</td>'
        . '<td>' . $this->formatMoney($itemSetArray['item']['price'], true) . '</td>'
        . '<td>' . $this->formatMoney(($itemSetArray['item']['price'] / $itemSetArray['item']['quantity']) / 3, true) . '</td>'
        . '<td><a onclick="removeRow(' . $itemSetArray['item']['productId'] . ')" class="deleteRow btn btn-danger">remove</a></td>'
        . '</tr>';

        //echo CJSON::encode($itemSetArray);
//		$itemSetArray = Product::model()->calculateItemSetFenzer($categoryId, $length, $provinceId, $productId);
//		echo $this->renderPartial('/fenzer/_edit_product_result', array(
//				'productResult'=>$itemSetArray,
//				),TRUE, TRUE);
    }

    public function actionUpdatePrice()
    {
//		$daiibuy = new DaiiBuy();
//		$daiibuy->loadCookie();
//		$provinceId = $daiibuy->provinceId;
        if (isset($_POST['Order'])) {
            $provinceId = $_POST['Order']['provinceId'];
            $title = $_POST['Order']['title'];
        }
        $productItems = array();
        if (isset($_POST['productItems']) && !empty($_POST['productItems'])) {
            $productItems = $_POST['productItems'];
        }
        if (isset($_POST['length']) && !empty($_POST['length'])) {
            $length = $_POST['length'];
        } else {
            $length = 0;
        }
        if (isset($_POST['categoryId']) && !empty($_POST['categoryId'])) {
            $categoryId = $_POST['categoryId'];
        }
        if (isset($_POST['cat1Id']) && !empty($_POST['cat1Id'])) {
            $cat1Id = $_POST['cat1Id'];
        }
        if ($length == 0) {
            $itemSetArray = Product::model()->calculateItemSetFenzerManualAndSave($cat1Id, $categoryId, $productItems, $provinceId, $length, FALSE, NULL, NULL);
        } else {
            $itemSetArray = Product::model()->calculateItemSetFenzer($cat1Id, $categoryId, $length, $provinceId);
        }

        echo $this->renderPartial('/fenzer/_edit_product_result', array(
            'productResult' => $itemSetArray,
        ), TRUE, TRUE);
    }

    public function actionSaveOrderMyFile()
    {
        $productItems = array();
        $orderId = NULL;

//		throw new Exception(print_r($_POST['Order'],true));

        if (isset($_POST['Order'])) {
            $provinceId = $_POST['Order']['provinceId'];
            $title = $_POST['Order']['title'];
        }

        if (isset($_POST['productItems']) && !empty($_POST['productItems'])) {
            $productItems = $_POST['productItems'];
        }
        if (isset($_POST['length']) && !empty($_POST['length'])) {
            $length = $_POST['length'];
//			throw new Exception(print_r($length,true));
        } else {
            $length = 0;
        }
        if (isset($_POST['categoryId']) && !empty($_POST['categoryId'])) {
            $categoryId = $_POST['categoryId'];
        }
        if (isset($_POST['cat1Id']) && !empty($_POST['cat1Id'])) {
            $cat1Id = $_POST['cat1Id'];
        }
        if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
            $orderId = $_POST['orderId'];
        }
        $itemSetArray = Product::model()->calculateItemSetFenzerManualAndSave($cat1Id, $categoryId, $productItems, $provinceId, $length, TRUE, $orderId, $title);

        echo $this->renderPartial('/fenzer/_confirm_order_myfile', array(
            'productResult' => $itemSetArray,
        ), TRUE, TRUE);
    }

// Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */

    public function actionView($id)
    {
        $this->layout = '//layouts/cl1';

        $model = Order::model()->findByPk($id);

        $productItems = $this->prepareProductItems($model);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $orderModel->type = 1;
            $orderModel->status = 1;

            if ($model->save()) {
                $this->redirect(array(
                    'index'
                ));
            }
        } else {
//			throw new Exception(print_r($productItems,true));
            $this->render('view', array(
                'model' => $model,
                'productResult' => $productItems,
            ));
        }
    }

    public function findLengthHeigtByOrderId($orderId)
    {
        $res = array();
        $orderDetail = OrderDetail::model()->find('orderId = ' . $orderId);
//		throw new Exception(print_r($orderDetail,true));
        $orderDetailValues = OrderDetailValue::model()->findAll('orderDetailId = ' . $orderDetail->orderDetailId);

        if (count($orderDetailValues) == 0) {
            $res['category1Id'] = 0;
            $res['height'] = 0;
            $res['length'] = 0;
            $res['category2Id'] = 0;
        } else {
            foreach ($orderDetailValues as $item) {
                if ($item->orderDetailTemplateFieldId == 1) {
                    $res['height'] = $item->value;
                } else if ($item->orderDetailTemplateFieldId == 2) {
                    $res['length'] = $item->value;
                } else if ($item->orderDetailTemplateFieldId == 3) {
                    $res['category1Id'] = $item->value;
                } else {
                    $res['category2Id'] = $item->value;
                }
            }
        }

        return $res;
    }

    public function prepareProductItems($model)
    {
        $res = array();
        $orderItems = $model->orderItems;
        $provinceId = $model->provinceId;
        $totalPrice = 0.00;
        $result = $this->findLengthHeigtByOrderId($model->orderId);
        $res['height'] = $result['height'];
        $res['length'] = $result['length'];
        $res['categoryId'] = $result['category2Id'];
        $res['cat1Id'] = $result['category1Id'];
        foreach ($orderItems as $item) {
            $productId = $item->productId;
            $product = Product::model()->findByPk($productId);

            //product
            $res['items'][$productId] = $product;

            //quantity
            $res['items'][$productId]['quantity'] = intval($item->quantity);
//			print_r($qty);
            //price
            $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                ":productId" => $productId));
            if (isset($productPromotion)) {
                //promotion price
                $res['items'][$productId]['price'] = Product::model()->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId) * 1;
            } else {
                //normal price
                $res['items'][$productId]['price'] = Product::model()->calProductTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId) * 1;
            }
            $totalPrice = $totalPrice + $res['items'][$productId]['price'];
            $categoryId = $product->categoryId;
        }
        $res['totalPrice'] = $totalPrice;
        $res['orderId'] = $model->orderId;

        return $res;
    }

    public function actionAddToCart()
    {
        if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
            $orderId = $_POST['orderId'];
            $model = Order::model()->findByPk($orderId);
            $model->type = 3;
            if ($model->save()) {
                echo 'success';
            }
        }
        echo 'fail';
    }

    public function actionFinish($id)
    {
//		$model = Order::model()->findByPk($id);
//		$model->status = 3;
//		$model->save();
        $this->redirect(array(
            'index'));
    }

}
