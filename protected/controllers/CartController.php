<?php

class CartController extends MasterController
{
    public function actionAddToCart()
    {
        $res = array();

        $res['result'] = 'success'.print_r($_POST, true);

        echo CJSON::encode($res);
    }
}