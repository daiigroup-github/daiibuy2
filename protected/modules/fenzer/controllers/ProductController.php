<?php

class ProductController extends MasterFenzerController
{

    public function actionIndex($id)
    {
        $product = array(
            'title' => 'Madrid Sanitary #1',
            'code' => 'PBS173',
            'category' => 'Sanitary',
            'stock' => '20',
            'dimension' => array(
                'w' => 100.00,
                'h' => 100.00,
                'l' => 100.00,
            ),
            'weight' => 80.50,
            'price' => 300,
            'pricePromotion' => 280,
            'productId' => 1,
            'options' => array(
                array(
                    'option1'),
                array(
                    'option2'),
            ),
            'tabs' => array(
                array(
                    'title' => 'Description',
                    'detail' => 'Detail Tab1'
                ),
                array(
                    'title' => 'Reviews',
                    'detail' => 'Detail Tab2'
                ),
                array(
                    'title' => 'Comments',
                    'detail' => 'Detail Tab3'
                ),
            ),
        );

        $this->render('index', array(
            'product' => $product));
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

    public function actionCalculateProductItems()
    {
        if (isset($_POST)) {
            $res = '';

//			throw new Exception(print_r($_POST, true));

            $category2Model = Category::model()->findByPk($_POST['categoryH']);
            $length = $_POST['l'];
            if ($_POST["categoryId"] != 111) {
                $noSpan = ceil($length / Product::SPAN_FENZER);
            } else {
                $noSpan = ceil($length / Product::SPAN_ZEN);
            }

            //Comment by tong change find product solution with cat1 and cat2
//			foreach($category2Model->fenzerToProducts as $fenzerProduct)
//			{
//				$qty = ($fenzerProduct->type == 1) ? $fenzerProduct->quantity * $noSpan : $fenzerProduct->quantity * ($noSpan + 1);
//				$res .= $this->generateTrByProductId($fenzerProduct->productId, $qty);
//			}
            $cat2ToProducts = Category2ToProduct::model()->findProductWithCat1AndCat2($_POST["categoryId"], $_POST['categoryH']);
            foreach ($cat2ToProducts as $fenzerProduct) {
                $qty = ($fenzerProduct->type == 1) ? $fenzerProduct->quantity * $noSpan : $fenzerProduct->quantity * ($noSpan + 1);
                $res .= $this->generateTrByProductId($fenzerProduct->productId, $qty);
            }
            echo $res;
        }
    }

    public function actionAddProductItem()
    {
        if (isset($_POST)) {
            $this->writeToFile('/tmp/fenzerAddItems', print_r($_POST, true));
            echo $this->generateTrByProductId($_POST['productId'], $_POST['qty']);
        }
    }

    /**
     * Generate TR by productId
     */
    private function generateTrByProductId($productId, $qty = 1)
    {
        $product = Product::model()->findByPk($productId);

        $price = ($product->calProductPromotionPrice() != 0) ? $product->calProductPromotionPrice() : $product->calProductPrice();

        return '<tr>' .
        '<td>' . $product->code . '</td>' .
        '<td>' . $product->name . '</td>' .
        '<td>' . number_format($product->calProductPrice(), 2) . '</td>' .
        '<td>' .
        '<div class="numeric-input full-width">' .
        '<input type="text" value="' . $qty . '" name="qty[' . $product->productId . ']"/>' .
        '<span class="arrow-up"><i class="icons icon-up-dir"></i></span>' .
        '<span class="arrow-down"><i class="icons icon-down-dir"></i></span>' .
        '</div>' .
        '</td>' .
        '<td>' . number_format($qty * $price, 2) . '</td>' .
        '<td><a class="btn btn-danger btn-xs removeProductItem"><i class="fa fa-ban"></i></a></td>' .
        '</tr>';
    }

    public function actionAddToCart()
    {
        //$this->writeToFile('/tmp/addToCartFenzer', print_r($_POST, true));

        $res = array();
        $supplier = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id),
        ));

        $this->cookie = new DaiiBuy();
        $this->cookie->loadCookie();

        $flag = false;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //code here
            $orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);

            $i = 0;
            foreach ($_POST['qty'] as $productId => $qty) {
                $orderItem = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId, $qty);
                $i++;
            }

            if ($i == sizeof($_POST['qty']))
                $flag = true;

            if ($flag) {
                $orderModel->totalIncVAT = $orderModel->orderItemsSum;
                $orderModel->save(false);

                $transaction->commit();
            } else {
                $transaction->rolback();
            }

            $res['result'] = $flag;
            echo CJSON::encode($res);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $transaction->rollback();
        }
    }

}
