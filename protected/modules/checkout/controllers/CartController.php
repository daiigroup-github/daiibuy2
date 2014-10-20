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
                'condition' => 'type&3 > 0 AND userId=:userId AND supplierId=:supplierId',
                'params' => array(
                    ':userId' => Yii::app()->user->id,
                    ':supplierId' => $id,
                ),
            ));
        } else {
            $orders = Order::model()->findAll(array(
                'condition' => 'type&3 > 0 AND token=:token AND supplierId=:supplierId',
                'params' => array(
                    ':token' => $daiibuy->token,
                    ':supplierId' => $id,
                ),
            ));
        }

        $this->render('cart', array(
            'orders' => $orders,
            'orderSummary' => Order::model()->sumOrderTotalBySupplierId($id)
        ));
    }

    public function actionUpdateCart(){
        if(isset($_POST['qty'])){
            $res = [];

            foreach ($_POST['qty'] as $orderItemsId => $qty) {
               $orderItem = OrderItems::model()->findByPk($orderItemsId);

                if($orderItem->quantity == $qty) {
                    continue;
                } else {
                    $orderItem->quantity = $qty;
                    $orderItem->save();
                }
            }

        }
    }
}