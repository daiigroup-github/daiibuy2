<?php

class CartController extends MasterCheckoutController
{
    public function actionIndex($id)
    {
        $carts = array(
            array(
                'title' => 'Other',
                'type' => 2,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title' => 'WC1',
                'type' => 3,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                    array(
                        'title' => 'Sanitary',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title' => 'WC2',
                'type' => 3,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                    array(
                        'title' => 'Sanitary',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
        );
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();

        $orders = array();

        if (isset(Yii::app()->user->id)) {
            $orders = Order::model()->findAll(array(
                'condition' => 'type&'.Order::ORDER_TYPE_CART.' > 0 AND userId=:userId AND supplierId=:supplierId',
                'params' => array(
                    ':userId' => Yii::app()->user->id,
                    ':supplierId' => $id,
                ),
                'order' => 'type, orderId'
            ));
        } else {
            $orders = Order::model()->findAll(array(
                'condition' => 'type&'.Order::ORDER_TYPE_CART.' > 0 AND token=:token AND supplierId=:supplierId',
                'params' => array(
                    ':token' => $daiibuy->token,
                    ':supplierId' => $id,
                ),
            ));
        }

        $this->render('cart', array(
            'orders' => $orders,
            'orderSummary' => Order::model()->sumOrderTotalBySupplierId($id),
            'supplierId'=>$id,
        ));
    }

    public function actionCheckout($id){
        Yii::app()->session['supplierId'] = $id;
        $this->redirect($this->createUrl('../checkout/step/1'));
    }

    public function actionUpdateCart(){
        if(isset($_POST['quantity'])){
            $res = [];

            foreach ($_POST['quantity'] as $orderItemsId => $quantity) {
               $orderItem = OrderItems::model()->findByPk($orderItemsId);

                if($orderItem->quantity == $quantity) {
                    continue;
                } else {
                    $orderItem->quantity = $quantity;
                    $orderItem->total = $orderItem->quantity * $orderItem->price;
                    $orderItem->save();

                    $res['orderItem'][$orderItem->orderItemsId]['total'] = number_format($orderItem->quantity * $orderItem->price, 2);
                }
            }

            $order = Order::model()->findByPk($_POST['orderId']);
            $order->totalIncVAT = $order->orderItemsSum;
            $order->save(false);
            $res['orderTotal'] = number_format($order->totalIncVAT, 2);
            $res['summary'] = $order->sumOrderTotalBySupplierId($order->supplierId);

            $this->writeToFile('/tmp/updatecart', print_r($res, true));
            echo CJSON::encode($res);
        }
    }
}