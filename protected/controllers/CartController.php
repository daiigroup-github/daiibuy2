<?php

class CartController extends MasterController
{
    public function actionAddToCart()
    {
        $res = array();

        $res['result'] = 'success' . print_r($_POST, true);

        echo CJSON::encode($res);
    }

    public function updateCartHeader()
    {
        //select distinct supplier from order
        $condition = '';
        $params = array();
        if (isset(Yii::app()->user->id)) {
            $condition = 'userId=:userId';
            $params = array(':userId' => Yii::app()->user->id);
        } else {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $condition = 'token=:token';
            $params = array(':token' => $daiibuy->token);
        }

        $supplierIds = Order::model()->findAll(array(
            'select' => 'distinct supplierId',
            'condition' => $condition,
            'params' => $params,
        ));

        $this->writeToFile('/tmp/updateCartHeader', print_r($supplierIds, true));
    }
}