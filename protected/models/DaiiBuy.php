<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class DaiiBuy extends CFormModel
{

    public $cartTotal = 0;
    public $usedPoint = 0;
    public $discount = array();
    public $cartItems = 0;
    public $cartRowTotal = 0;
    public $amphurId;
    public $provinceId;
    public $cart = array();
    public $order = array();

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
//			// username and password are required
//			array('email, password', 'required'),
//			// rememberMe needs to be a boolean
//			array('rememberMe', 'boolean'),
//			// password needs to be authenticated
//			array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array( //			'rememberMe'=>'Remember me next time',
        );
    }

    public function loadCookie()
    {
        //unsetCookie();
        if (isset(Yii::app()->request->cookies['daiibuy'])) {
            $daiibuy = json_decode(Yii::app()->request->cookies['daiibuy'], true);
            $handle = fopen('/tmp/loadCookie', 'w+');
            fwrite($handle, print_r($daiibuy['provinceId'], true));
            fclose($handle);
            $this->amphurId = $daiibuy['amphurId'];
            $this->cart = $daiibuy['cart'];
            $this->usedPoint = $daiibuy['usedPoint'];
            $this->provinceId = $daiibuy['provinceId'];
            if (isset($daiibuy['order']))
                $this->order = $daiibuy['order'];

            /*
            if(isset($daiibuy['cart']))
            {
                $cart = Product::model()->cartSummary($daiibuy['cart'], $this->amphurId);
                $this->cartTotal = $cart['cartTotal'];
                $this->discount = $daiibuy['discount'];
                $this->cartItems = $cart['cartItems'];
                $this->cartRowTotal = $cart['cartRowTotal'];
            }
            */
        }
        //return array('cartTotal'=>$cartTotal, 'cartItems'=>$cartItems);
    }

    public function saveCookie()
    {
        $daiibuy['cart'] = $this->cart;
        $daiibuy['amphurId'] = $this->amphurId;
        $daiibuy['order'] = $this->order;
        $daiibuy['cartTotal'] = $this->cartTotal;
        $daiibuy['cartItems'] = $this->cartItems;
        $daiibuy['cartRowTotal'] = $this->cartRowTotal;
        $daiibuy['usedPoint'] = $this->usedPoint;
        $daiibuy['discount'] = $this->discount;
        $daiibuy['provinceId'] = $this->provinceId;

        $cookie = new CHttpCookie('daiibuy', json_encode($daiibuy));
        $cookie->expire = time() + (60 * 60 * 24);
        Yii::app()->request->cookies['daiibuy'] = $cookie;
    }

    public function unsetCookie()
    {
        unset(Yii::app()->request->cookies['daiibuy']);
    }

    public function getTotalDiscount()
    {
        $res = 0.00;
        foreach ($this->discount as $supplierId => $value) {
            $res += $value;
        }

        return $res;
    }
}
