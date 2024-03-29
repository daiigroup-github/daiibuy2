<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $orderId
 * @property string $supplierId
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property User $supplier
 * @property OrderGroupToOrder[] $orderGroupToOrders
 * @property integer $sumTotal
 */
class Order extends OrderMaster
{

    public $maxCode;
    public $searchText;
    public $orderError;
    public $marginToDealer;
    public $marginToDaii;
    public $sumMarginDealer;
    public $sumTotal;
    public $category2Id;
    public $brandModelId;

    const ORDER_TYPE_MYFILE = 1;
    const ORDER_TYPE_CART = 2;
    const ORDER_TYPE_MYFILE_TO_CART = 3;
    const ORDER_TYPE_ADD_TO_ORDER_GROUP = 4;

    /**
     * @return string the associated database table name
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return CMap::mergeArray(parent::rules(), array(
//code here
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(
//code here
            'shippingAmphur' => array(
                self::BELONGS_TO,
                'Amphur',
                array(
                    'shippingAmphurId' => 'amphurId'),),
            'shippingProvince' => array(
                self::BELONGS_TO,
                'Province',
                array(
                    'shippingProvinceId' => 'provinceId'),),
            'shippingDistrict' => array(
                self::BELONGS_TO,
                'District',
                array(
                    'shippingDistrictId' => 'districtId'),),
            'orderItemsSum' => array(
                self::STAT,
                'OrderItems',
                'orderId',
                'select' => 'sum(total)'
            ),
            'user' => array(
                self::BELONGS_TO,
                'User',
                'userId'),
            'orderGroups' => array(
                self::MANY_MANY,
                'OrderGroup',
                'order_group_to_order(orderId,orderGroupId)'
            ),
            'userSpacialProject' => array(
                self::HAS_MANY,
                'UserSpacialProject',
                'orderId'),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array());
    }

    public function findAllMyFileBySupplierId($userId, $supplierId, $token)
    {
        $criteria = new CDbCriteria();
        if (($userId != 0)) {
            if ($supplierId == 4) {
                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ' OR type = ' . self::ORDER_TYPE_CART . ') AND (status = 1 OR status = 0)';
            } else if ($supplierId == 3) {
                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ') AND (status in(0,1,2,3))';
            } else {

                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ') AND (status in(0,1,2))';
            }

            $criteria->params = array(
                ':userId' => $userId,
                ':supplierId' => $supplierId,);
        } else {
            if ($supplierId == 4) {

                $criteria->condition = 'token = :token AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ' OR type = ' . self::ORDER_TYPE_ADD_TO_ORDER_GROUP . ') AND (status = 1 OR status = 0)';
            } else {
                $criteria->condition = 'token = :token AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ') AND (status = 1 OR status = 0)';
            }
            $criteria->params = array(
                ':token' => $token,
                ':supplierId' => $supplierId,);
        }
        $res = $this->findAll($criteria);
        return $res;
    }

    public function isAddThisModel($productId, $provinceId, $userId = NULL, $token = NULL)
    {
        $res = true;
        if (isset($userId)) {
            $orders = Order::model()->findAll('supplierId = 4 AND userId = ' . $userId . ' AND provinceId = ' . $provinceId . ' AND type = 2');
        } else {
            $orders = Order::model()->findAll('supplierId = 4 AND token = "' . $token . '" AND provinceId = ' . $provinceId . ' AND type = 2');
        }
        foreach ($orders as $order) {
            foreach ($order->orderItems as $item) {
//	throw new Exception(print_r($item,true));
                $res = ($item->productId == $productId) ? true : false;
            }
        }
        return $res;
    }

    public function findAllMyFileHistoryBySupplierId($userId, $supplierId, $token)
    {

        $criteria = new CDbCriteria();
        if (($userId != 0)) {
            if ($supplierId == 4) {
                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_ADD_TO_ORDER_GROUP . ') AND (status = 1 OR status = 0)';
            } else if ($supplierId == 3) {
                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_ADD_TO_ORDER_GROUP . ') AND (status in(0,1,2,3))';
            } else {

                $criteria->condition = 'userId = :userId AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_ADD_TO_ORDER_GROUP . ') AND (status = 2)';
            }

            $criteria->params = array(
                ':userId' => $userId,
                ':supplierId' => $supplierId,);
        } else {

            if ($supplierId == 4) {

                $criteria->condition = 'token = :token AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ' OR type = ' . self::ORDER_TYPE_ADD_TO_ORDER_GROUP . ') AND (status = 1 OR status = 0)';
            } else {
                $criteria->condition = 'token = :token AND supplierId = :supplierId AND (type = ' . self::ORDER_TYPE_MYFILE . ' OR type = ' . self::ORDER_TYPE_MYFILE_TO_CART . ') AND (status = 1 OR status = 0)';
            }
            $criteria->params = array(
                ':token' => $token,
                ':supplierId' => $supplierId,);
        }

        $res = $this->findAll($criteria);

        return $res;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     * public function search()
     * {
     * }
     */

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public function findMaxInvoiceNo($model)
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
        $supplierUser = User::model()->findByPk($model->supplierId);

        $criteria = new CDbCriteria;

        $criteria->select = 'max(RIGHT(invoiceNo,6)) as maxCode';
//		if(isset($supplierUser->redirectURL))
//		{
        $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND supplierId = ' . $supplierUser->userId . ' AND paymentMethod = ' . $model->paymentMethod;
//		}
//		else
//		{
//			$supplierArray = array();
//			$supplierArray = User::model()->findAllSupplierHasRedirectURL();
//			$criteria->condition = 'MONTH(updateDateTime) = MONTH(NOW())';
//		$criteria->addNotInCondition('supplierId', $supplierArray);
//		}
        $result = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
        return isset($result->data[0]) ? $result->data[0]->maxCode : 0;
    }

    public function findMaxOrderNo()
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

        $criteria = new CDbCriteria;

        $criteria->select = 'max(RIGHT(orderNo,6)) as maxCode';
        $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW())';

        $result = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
        return isset($result->data[0]) ? $result->data[0]->maxCode : 0;
    }

    public function findAllUserOrder()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("userId", Yii::app()->user->id);
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findAllDealerOrder()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("dealerId", Yii::app()->user->id);
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
//		$criteria->compare("status", ">2");
//		$criteria->compare("status", "<99");
        $criteria->addCondition(" (status = 0 AND userId = " . Yii::app()->user->id . ") OR ( status >2 AND status < 99) ");
//$criteria->compare("status",2);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findAllSupplierMyfile()
    {
        $criteria = new CDbCriteria();
        if (Yii::app()->user->userType != 4) {
            $criteria->compare("supplierId", Yii::app()->user->supplierId);
        }
        $criteria->compare("status", 0);
//		$criteria->compare("type", 1);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.status ASC ,t.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findAllSupplierOrder()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("supplierId", Yii::app()->user->supplierId);
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare("status", ">2");
        $criteria->compare("status", "<99");
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findAllFinanceAdminOrder()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "status in (1 , 4 , 6 , 7 , 8 , 11 , 12 ,13, 14 ,15 ,16,98 ) ";
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('paymentMethod', $this->paymentMethod, true);
        $criteria->compare("status", ">0");
        $criteria->compare("status", "<99");
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findAllFinanceAdminOrderPay()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "status > 1 AND paymentDateTime is not NULL";
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare("status", ">1");
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function findGuestOrder()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("orderNo", $this->orderNo, FALSE, "AND");
        $criteria->compare("email", $this->email, FALSE, "AND");
        $criteria->compare("userId", 0);
        $guestOrder = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
        return $guestOrder;
    }

//Use in report
    public function getNotpaySupplierOrder()
    {
        $criteria = new CDbCriteria();
        if (isset($this->supplierId)) {
            $criteria->compare("supplierId", $this->supplierId);
            $criteria->addInCondition("orderStatusid", array(
                "11",
                "13"));
        }
//$criteria->compare("orderStatusid","in(4,6,7");
        $criteria->group = "supplierId";

        return $this->findAll($criteria);
    }

    public function getNotpayDealerOrder()
    {
        $criteria = new CDbCriteria();
        if (isset($this->dealerId)) {
            $criteria->compare("dealerId", $this->dealerId);
            $criteria->addInCondition("orderStatusid", array(
                "11",
                "12"));
        }
//$criteria->compare("orderStatusid","in(4,6,7");
        $criteria->group = "dealerId";

        return $this->findAll($criteria);
    }

    public function getSumOrderBySupplier($supplierId)
    {
        $totals = Yii::app()->db->createCommand()
        ->select('sum(total+pointToBaht) as totals')
        ->from('order')
        ->where('supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 13 OR order.orderStatusid = 16) ')
        ->queryRow();
        return $totals;
    }

    public function getSumOrderBySupplierTransferd($supplierId)
    {
        $totals = Yii::app()->db->createCommand()
        ->select('sum(total+pointToBaht) as totals')
        ->from('order')
        ->where('supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 12 OR order.orderStatusid = 14 OR order.orderStatusid = 15 OR order.orderStatusid = 16) ')
        ->queryRow();
        return $totals;
    }

    public function getSumOrderByDealerTransferd($dealerId)
    {
        $totals = Yii::app()->db->createCommand()
        ->select('sum(total+pointToBaht) as totals')
        ->from('order')
        ->where('dealerId = ' . $dealerId . ' AND ' . '(order.orderStatusid = 13 OR order.orderStatusid = 14 OR order.orderStatusid = 16 OR order.orderStatusid = 15) ')
        ->queryRow();
        return $totals;
    }

    public function getSumMarginDealer($dealerId)
    {
        $totalDealerMargin = Yii::app()->db->createCommand()
        ->select('sum((((order.total+order.pointToBaht)*user_certificate_file.value)/100)) as sumMarginDealer')
        ->from('order')
        ->join('user_certificate_file', 'order.supplierId = user_certificate_file.userId AND user_certificate_file.forUserType = 2 ')
        ->join('user_certificate_file ucf', 'order.supplierId = ucf.userId AND ucf.forUserType = 3 ')
        ->where('order.dealerId = ' . $dealerId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 12 OR order.orderStatusid = 15) AND user_certificate_file.status = 1 ')
        ->queryRow();
        return $totalDealerMargin;
    }

    public function getSumMargin($supplierId)
    {
        $totalMargin = Yii::app()->db->createCommand()
        ->select('sum(((order_product.total*1.07)*user_certificate_file.value)/100) as totalMargin')
        ->from('order')
        ->join('order_product', 'order.orderId = order_product.orderId')
        ->join('user_certificate_file', 'order_product.marginId = user_certificate_file.id')
        ->where('order.supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 13 OR order.orderStatusid = 16) AND user_certificate_file.forUserType = 3 ')
        ->queryRow();
        return $totalMargin;
    }

    public function findOrderBySupplierId($supplierId)
    {
        $criteria = new CDbCriteria();
        $criteria->compare("supplierId", $supplierId);
        $criteria->addInCondition("orderStatusid", array(
            "11",
            "13",
            "16"));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function findOrderByDealerId($dealerId)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "t.orderId,
					t.invoiceNo,
					t.orderNo,
					t.paymentFirstname,
					t.paymentLastname,
					t.orderStatusid,
					t.total+t.pointToBaht as total, ((t.total+t.pointToBaht)*ucf.value)/100 as marginToDaii, (((t.total+t.pointToBaht)*uc.value)/100) as marginToDealer ";
        $criteria->join = "JOIN user_certificate_file uc ON t.supplierId = uc.userId AND uc.forUserType = 2 ";
        $criteria->join .= "JOIN order_product op ON t.orderId = op.orderId ";
        $criteria->join .= "JOIN user_certificate_file ucf ON op.marginId = ucf.id AND t.supplierId = ucf.userId AND ucf.forUserType = 3 ";
        $criteria->compare("t.dealerId", $dealerId);
//		$criteria->compare("uc.forUserType", 2);
//		$criteria->compare("ucf.forUserType", 3);
        $criteria->addInCondition("orderStatusid", array(
            "11",
            "12",
            "15"));
        $criteria->group = "t.orderId";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria));
    }

    public function findOrderBySupplierIdTransfered($supplierId)
    {
        $criteria = new CDbCriteria();
        $criteria->compare("supplierId", $supplierId);
        $criteria->addInCondition("orderStatusid", array(
            "12",
            "14",
            "15",
            "16"));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function findOrderByDealerIdTransfered($dealerId)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "t.orderId,t.invoiceNo,
					t.orderNo,
					t.paymentFirstname,
					t.paymentLastname,
					t.orderStatusid,
					(t.total+t.pointToBaht) as Total, ((t.total+t.pointToBaht)*ucf.value)/100 as marginToDaii, ((((t.total+t.pointToBaht)*ucf.value)/100)*uc.value)/100 as marginToDealer ";
        $criteria->join = "JOIN user_certificate_file uc ON t.supplierId = uc.userId AND uc.forUserType = 2 ";
        $criteria->join .= "JOIN order_product op ON t.orderId = op.orderId ";
        $criteria->join .= "JOIN user_certificate_file ucf ON op.marginId = ucf.id AND t.supplierId = ucf.userId AND ucf.forUserType = 3 ";
        $criteria->compare("t.dealerId", $dealerId);
        $criteria->addInCondition("orderStatusid", array(
            "13",
            "14",
            "15",
            "16"));
        $criteria->group = "t.orderId";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria));
    }

    public function getSupplierRewardPoint()
    {

        $margin = Yii::app()->db->createCommand()
        ->select('value as userReward')
        ->from('user_certificate_file')
        ->where('supplierId = :id and status = 1', array(
            'id' => $this->supplierId))
        ->queryRow();
        return $margin;
    }

//	public function getSupplierMarginToDaiiBuy()
//	{
//		$totals = Yii::app()->db->createCommand()
//			->select('value as daiiMargin')
//			->from('order t')
//			->join('order_items op', 't.orderId = op.orderId')
//			->join('user_certificate_file ucf', 'op.marginId = ucf.id')
//			->where('t.orderId=:id', array(
//				':id'=>$this->orderId))
//			->group('t.orderId')
//			->queryRow();
//		return $totals;
//	}

    public function getCollectedOrderView($userId)
    {
        $value = Configuration::model()->getOrderExpiredDate();
        $orders = Order::model()->findAll('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND orderStatusid < 99 AND userId = ' . $userId);
        $res = 0;
        foreach ($orders as $order) {
            $res = $res + $order->total;
        }

//		$res = Yii::app()->db->createCommand()
//				->select('sum(total) as collectedOrder')
//				->from('order')
//				->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId . ' AND isChangeToReward = 0')
//				->queryRow();
//		return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
        return $res;
    }

    public function getCollectedOrder($userId)
    {
        $value = Configuration::model()->getOrderExpiredDate();
        $orders = Order::model()->findAll('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId);
        $res = 0.00;
        foreach ($orders as $order) {
            $res = $res + ($order->totalIncVAT - $order->usedPoint);
//			$order->isChangeToReward = 1;
//$order->save();
        }

//		$res = Yii::app()->db->createCommand()
//				->select('sum(total) as collectedOrder')
//				->from('order')
//				->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId . ' AND isChangeToReward = 0')
//				->queryRow();
//		return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
        return $res;
    }

    public function clearCollectedOrder($userId)
    {
        $value = Configuration::model()->getOrderExpiredDate();
        $res = Yii::app()->db->createCommand()
        ->select('sum(total) as collectedOrder')
        ->from('order')
        ->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId)
        ->queryRow();
        return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
    }

    public function showOrderStatus($status)
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        switch ($status) {
            case 0:
                return "รอผู้ผลิตถอดแบบ";
                break;
            case 1:
                return "ใช้งาน";
                break;
        }
    }

    public function showOrderType($type)
    {
        switch ($type) {
            case 1:
                return "Myfile";
                break;
            case 2:
                return "Cart";
                break;
            case 3:
                return "Myfile To Cart";
                break;
        }
    }

    public function formatMoney($number, $fractional = false)
    {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }

    public function beforeSave()
    {

        if (!$this->isNewRecord) {
            $this->updateDateTime = new CDbExpression("NOW()");
        }

        return parent::beforeSave();
    }

//Summary Report

    public $paymentYear;
    public $paymentMonth;
    public $totalSummary;

    public function findAllSummaryReport()
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
        $criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
        $criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
        $criteria->compare("status", ">=2");
        $criteria->compare("status", "<> 99");
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.orderNo',
            ),
            'pagination' => array(
                'pageSize' => 50
            ),
        ));
    }

    public function findTotalSummaryReport()
    {
        $criteria = new CDbCriteria;
        $criteria->select = "sum(totalIncVat) as totalSummary";
        $criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
        $criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
        $criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
        $criteria->compare("status", ">=2");
        $criteria->compare("status", "<> 99");
        return $this->find($criteria)->totalSummary;
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        if (isset($this->searchText) && !empty($this->searchText)) {
            $this->orderNo = $this->searchText;
            $this->title = $this->searchText;
            $this->type = $this->searchText;
        }

        $criteria->compare('orderNo', $this->orderNo, true, 'OR');
        $criteria->compare('title', $this->title, true, 'OR');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    /**
     * Front
     */
    public function findByTokenAndSupplierId($token, $supplierId)
    {
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();

        $condition = 'type =2 AND supplierId=:supplierId AND status=0';
        $params = array(
            ':supplierId' => $supplierId,
        );

        if (isset(Yii::app()->user->id)) {
            $condition .= ' AND userId=:userId';
            $params[':userId'] = Yii::app()->user->id;
        } else {
            $condition .= ' AND token=:token';
            $params[':token'] = $daiibuy->token;
        }

        $model = $this->find(array(
            'condition' => $condition,
            'params' => $params,
        ));

        if (!isset($model)) {
            $model = new Order();
            $model->token = $token;
            $model->supplierId = $supplierId;
            $model->provinceId = $daiibuy->provinceId;
            $model->type = self::ORDER_TYPE_CART;
            $model->createDateTime = $model->updateDateTime = new CDbExpression('NOW()');

            if (isset(Yii::app()->user->id)) {
                $model->userId = Yii::app()->user->id;
            }

            $model->save(false);
        }
        return $model;
    }

    public function countGinzaHomeAndGinzaTownUnits()
    {
//		$cartUnits = 0;
//
//		$condition = 'supplierId=:supplierId AND type&' . self::ORDER_TYPE_CART . ' > 0';
//		$params = [':supplierId'=>isset($supplierId) ? $supplierId : $this->supplierId];
////		$discountPercent = 0;
//
//		if(isset(Yii::app()->user->id))
//		{
//			$condition .= ' AND userId=:userId';
//			$params[':userId'] = Yii::app()->user->id;
//		}
//		else
//		{
//			$daiibuy = new DaiiBuy();
//			$daiibuy->loadCookie();
//			$condition .= " AND token='" . $daiibuy->token . "'";
//		}
//
//		$models = $this->findAll(array(
//			'condition'=>$condition,
//			'params'=>$params,
//		));
//		foreach($models as $order)
//		{
//			foreach($order->orderItems as $item)
//			{
//				$cartUnits +=$item->quantity;
//			}
//		}
        $totalUnits = 0;
        if (isset(Yii::app()->user->id)) {
            $buyModels = OrderGroup::model()->findAll('(supplierId = 4 OR supplierId = 5) AND status > 2 AND parentId is NULL and userId = ' . Yii::app()->user->id);

//		throw new Exception(print_r($buyModels,true));
            foreach ($buyModels as $orderGroup) {
                foreach ($orderGroup->orders as $order) {
                    foreach ($order->orderItems as $item) {
                        $totalUnits+=$item->quantity;
                    }
                }
            }
        }
//		throw new Exception(print_r($cartUnits + $totalUnits,true));
        return $totalUnits;
    }

    public function sumExtraDiscount($supplierId, $supplierDiscountRangePercent)
    {

        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = "t.orderId as orderId , usp.spacialPercent as spacialPercent , t.totalIncVAT as totalIncVAT ";
        $criteria->join = "INNER JOIN user_spacial_project usp ON usp.orderId = t.orderId ";
        $criteria->condition = "usp.status = 2 AND t.supplierId = $supplierId AND type in (" . self::ORDER_TYPE_CART . "," . self::ORDER_TYPE_MYFILE_TO_CART . " ) ";
        if (isset(Yii::app()->user->id)) {
            $criteria->condition .= " AND t.userId =" . Yii::app()->user->id;
        } else {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $criteria->condition .= " AND t.token ='" . $daiibuy->token . "'";
        }

        $models = $this->findAll($criteria);
//				throw new Exception(print_r($models,true));
        $extraDiscount = 0;
        foreach ($models as $item) {


            $spacialValue = ($item->totalIncVAT * ((100 - $supplierDiscountRangePercent ) / 100)) * ($item->spacialPercent / 100);
//			throw new Exception(print_r($item, true));
            $result[$item->orderId] = array(
                'extraDiscountPercent' => $item->spacialPercent,
                'extraDiscount' => $spacialValue,
            );

            $extraDiscount += $spacialValue;
        }

        $result["totalExtraDiscount"] = $extraDiscount;
        if (count($models) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function sumOrderTotalBySupplierId($supplierId = NULL)
    {
        $res = [];
        $condition = 'supplierId=:supplierId AND type&' . self::ORDER_TYPE_CART . ' > 0';
        $params = [':supplierId' => isset($supplierId) ? $supplierId : $this->supplierId];
        $discountPercent = 0;

        if (isset(Yii::app()->user->id)) {
            $userId = Yii::app()->user->id;
            $condition .= ' AND userId=:userId';
            $params[':userId'] = Yii::app()->user->id;
        } else {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $condition .= " AND token='" . $daiibuy->token . "'";
        }

//		$model = $this->find(array(
//			'select'=>'sum(totalIncVAT) as sumTotal',
//			'condition'=>$condition,
//			'params'=>$params,
//		));

        $models = $this->findAll(array(
            'condition' => $condition,
            'params' => $params,
        ));
        $sumTotal = 0;
        $noOfBuy = 0;
        foreach ($models as $order) {
            foreach ($order->orderItems as $item) {
                $price = ($item->product->calProductPromotionPrice() != 0) ? $item->product->calProductPromotionPrice() : $item->product->calProductPrice();
                if (isset($item->orderItemOptions)) {
                    foreach ($item->orderItemOptions as $option) {
                        $price += $option->total;
                    }
                }
                $priceHome = $price;
                $sumTotal+=($price * $item->quantity);
                $noOfBuy +=$item->quantity;
            }
        }
//                                            throw new Exception(print_r($noOfBuy,true));

        if (!isset(Yii::app()->user->id)) {

            if ($supplierId == 4 || $supplierId == 5) {
                $noOfUnits = $this->countGinzaHomeAndGinzaTownUnits();
//				throw new Exception(print_r($noOfUnits,true));
                $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $noOfUnits + $noOfBuy);
            } else {
                $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $sumTotal);
            }
        } else {
            $sumLastTwelveMonth = OrderGroup::model()->sumOrderLastTwelveMonth();
            $sumAll = $sumTotal + $sumLastTwelveMonth;
            if ($supplierId == 4 || $supplierId == 5) {
                if (isset(Yii::app()->user->id)) {
                    $user = " AND userId= " . Yii::app()->user->id . " ";
                } else {
                    $daiibuy = new DaiiBuy();
                    $daiibuy->loadCookie();
                    $user = " AND token= '" . $daiibuy->token . "' ";
                }

//				$ogs = OrderGroup::model()->findAll("supplierId =" . $supplierId . $user . " AND parentId is null");
//				if(isset($ogs) && count($ogs) > 0)
//				{
//					foreach($ogs as $og)
//					{
//						foreach($og->orders as $orders)
//						{
//							foreach($orders->orderItems as $item)
//							{
//								$noOfBuy+=$item->quantity;
//							}
//						}
//					}
//				}
//				$sumAll = $noOfBuy;
//			}
//			if($supplierId == 4 || $supplierId == 5)
//			{

                $noOfUnitsBuy = $this->countGinzaHomeAndGinzaTownUnits();

//                				throw new Exception(print_r($noOfUnitsBuy,true));
                $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $noOfBuy + $noOfUnitsBuy);
            } else {
                $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $sumAll);
            }
        }
        $discount = $sumTotal * $discountPercent / 100;
        $grandTotal = $sumTotal - $discount;
        $distributorDiscountPercent = 0;

        if (isset(Yii::app()->user->userType) && Yii::app()->user->userType == 2) {
            //edit 3 to other when change policy discount of distributor
            $distributorDiscountPercent += 3;
        }
        $totalPostSupplierRangeDiscount = $grandTotal;
        $res['totalPostSupplierRangeDiscount'] = number_format($grandTotal, 2);
        if (isset($userId)) {
            $user = User::model()->findByPk($userId);
            if (isset($user->partnerCode))
                $partnerDiscount = UserPartner::model()->findPartnerDiscount($userId, $supplierId, $sumTotal);
//            throw new Exception(print_r($partnerDiscount, true));
            if (isset($partnerDiscount)) {
                //throw new Exception($partnerDiscount["discountType"]);
                if ($partnerDiscount["discountType"] == 2) {
                    $partnerDiscountPercent = $partnerDiscount["discount"];
                    //$partnerDiscountValue = $partnerDiscount["discount"] * $sumTotal / 100;
                    $partnerDiscountValue = $grandTotal * ($partnerDiscountPercent / 100);
                } else {

                    if (isset($sumTotal) && $sumTotal > 0) {

                        //throw new Exception(111);
                        //$partnerDiscountPercent = ($partnerDiscount["discount"] * 100) / $sumTotal;
                        //Sak Modify for use partner type cash
                        $partnerDiscountPercent = -1;
                        //Sak Modify for use partner type cash
                        $partnerDiscountValue = $partnerDiscount["discount"];
                    } else {
                        $partnerDiscountPercent = $partnerDiscount["discount"];
                        $partnerDiscountValue = $grandTotal * ($partnerDiscountPercent / 100);
                    }
                }

                if ($supplierId == 4 || $supplierId == 5) {
//                    throw new Exception(($sumTotal / $noOfBuy));
//					throw new Exception(print_r($noOfBuy, true));
                    // throw new Exception($supplierId);
                    if ($noOfBuy > 0 && !(($sumTotal / $noOfBuy) < 200000)) {
                        $grandTotal = $grandTotal - $partnerDiscountValue;
                        $res['partnerDiscountPercent'] = $partnerDiscountPercent;
                        $res['partnerDiscount'] = number_format($partnerDiscountValue, 2);
                        $res['totalPostPartnerDiscount'] = number_format($grandTotal, 2);
                        //throw new Exception('aaa');
                    } else {
                        $grandTotal = $grandTotal - $partnerDiscountValue;
                        $res['partnerDiscountPercent'] = $partnerDiscountPercent;
                        $res['partnerDiscount'] = number_format($partnerDiscountValue, 2);
                        $res['totalPostPartnerDiscount'] = number_format($grandTotal, 2);
                    }
                } else {
                    $grandTotal = $grandTotal - $partnerDiscountValue;
                    $res['partnerDiscountPercent'] = $partnerDiscountPercent;
                    $res['partnerDiscount'] = number_format($partnerDiscountValue, 2);
                    $res['totalPostPartnerDiscount'] = number_format($grandTotal, 2);
                }
            } else {
                if ($distributorDiscountPercent > 0) {
                    $distributorDiscount = $grandTotal * $distributorDiscountPercent / 100;
                    $grandTotal = $grandTotal - $distributorDiscount;
                    $res['distributorDiscountPercent'] = $distributorDiscountPercent;
                    $res['distributorDiscount'] = number_format($distributorDiscount, 2);
                    $res['totalPostDistributorDiscount'] = number_format($grandTotal, 2);
                }
            }
            //throw new Exception(print_r($sumTotal, true));
        }
        $res['discountPercent'] = $discountPercent;
        $res['discount'] = number_format($discount, 2);
        $res['total'] = number_format($sumTotal, 2);
        $extraDiscountArray = $this->sumExtraDiscount($supplierId, $discountPercent);
        if (isset($extraDiscountArray)) {
            $grandTotal -=$extraDiscountArray["totalExtraDiscount"];
            $res["extraDiscount"] = number_format($extraDiscountArray["totalExtraDiscount"], 2);
            $res["extraDiscountArray"] = $extraDiscountArray;
            $res['totalPostExtraDiscount'] = number_format($totalPostSupplierRangeDiscount, 2);
        }
        $res['grandTotal'] = number_format($grandTotal, 2);
        return $res;
    }

    public $spacialPercent;

    public function sumOrderTotalByProductIdAndQuantity($productId = null, $quantity, $supplierId, $payValue = NULL, $useDiscount = FALSE, $orderGroupId = NULL)
    {
        if (isset($orderGroupId))
            $orderGroupModel = OrderGroup::model()->findByPk($orderGroupId);
        $res = [];
        if (isset(Yii::app()->user->id)) {
            $user = " AND userId= " . Yii::app()->user->id . " ";
        } else {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $user = " AND token= '" . $daiibuy->token . "' ";
        }
        $sumTotal = 0;
        if (isset($productId)) {
            $product = Product::model()->findByPk($productId);
            $price = ($product->calProductPromotionPrice() != 0) ? $product->calProductPromotionPrice() : $product->calProductPrice();
            $sumTotal+=($price * $quantity);
        } else {
            $sumTotal +=$payValue;
        }
        $sumLastTwelveMonth = OrderGroup::model()->sumOrderLastTwelveMonth();
        $sumAll = $sumTotal + $sumLastTwelveMonth;
        if ($supplierId == 4 || $supplierId == 5) {
            $noOfBuy = 0;
//			$ogs = OrderGroup::model()->findAll("supplierId =" . $supplierId . $user . " AND parentId is null AND status =3"); // Discount when confirm by finance admin
            $ogs = OrderGroup::model()->findAll("supplierId =" . $supplierId . $user . " AND parentId is null and status > 2 ");
            if (isset($ogs) && count($ogs) > 0) {
                foreach ($ogs as $og) {
                    foreach ($og->orders as $orders) {
                        foreach ($orders->orderItems as $item) {
                            $noOfBuy+=$item->quantity;
                        }
                    }
                }
            }
//			$sumAll = $noOfBuy;
        }
//                throw new Exception(print_r($orderGroupModel, true));
        if ($noOfBuy > 0)
            $useDiscount = TRUE;
        if ($useDiscount) {
            if (!isset($orderGroupModel->parentId)) {
                $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $noOfBuy + 1);
            } else {
                $discountPercent = $orderGroupModel->discountPercent;
            }
        } else {
            $discountPercent = 0;
        }
        $discount = $sumTotal * $discountPercent / 100;
        $grandTotal = $sumTotal - $discount;
        $distributorDiscountPercent = 0;

        if (isset(Yii::app()->user->userType) && Yii::app()->user->userType == 2) {
            //edit 3 to other when change policy discount of distributor
            $distributorDiscountPercent += 3;
        }
        $res['totalPostSupplierRangeDiscount'] = number_format($grandTotal, 2);
        if ($distributorDiscountPercent > 0) {
            $distributorDiscount = $grandTotal * $distributorDiscountPercent / 100;
            $grandTotal = $grandTotal - $distributorDiscount;
        }
//		throw new Exception(print_r($sumTotal, true));
        $res['total'] = number_format($sumTotal, 2);
        $res['discountPercent'] = $discountPercent;
        $res['discount'] = number_format($discount, 2);
        if ($distributorDiscountPercent > 0 && isset($distributorDiscount)) {
            $res['distributorDiscountPercent'] = $distributorDiscountPercent;
            $res['distributorDiscount'] = number_format($distributorDiscount, 2);
            $res['totalPostDistributorDiscount'] = number_format($grandTotal, 2);
        }
        if ($supplierId != 5) {
            $extraDiscountArray = $this->sumExtraDiscount($supplierId, $discountPercent);
        } else {
            $extraDiscountArray = OrderGroup::model()->sumExtraDiscount($supplierId, $discountPercent, $grandTotal, $orderGroupId);
        }
        if (isset($extraDiscountArray)) {
            $grandTotal -=$extraDiscountArray["totalExtraDiscount"];
            $res["extraDiscount"] = number_format($extraDiscountArray["totalExtraDiscount"], 2);
            $res["extraDiscountArray"] = $extraDiscountArray;
            $res['totalPostExtraDiscount'] = number_format($grandTotal, 2);
        }
        $res['grandTotal'] = number_format($grandTotal, 2);
        return $res;
    }

}
