<?php

/**
 * This is the model class for table "order_group".
 *
 * The followings are the available columns in table 'order_group':
 * @property string $orderGroupId
 * @property string $userId
 * @property string $Ordercol
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderGroupToOrder[] $orderGroupToOrders
 *
 * @property inetger $sumTotal
 */
//status 97 = sending e-payment
class OrderGroup extends OrderGroupMaster
{

//Summary Report

    public $paymentYear;
    public $paymentMonth;
    public $supplierSelected;
    public $totalSummary;
    public $maxCode;
    public $sumTotal;
    public $spacialPercent;

    const STATUS_ORDER = 1;
    const STATUS_COMFIRM_TRANSFER = 2;
    const STATUS_APPROVE_TRANSFER = 3;
    const STATUS_SUPPLIER_SHIPPING = 4;
    const STATUS_SENDING_EPAYMENT = 97;
    const VAT_PERCENT = 7;
    const EMAILPERIOD1 = "";
    const EMAILPERIOD2 = "";
    const EMAILPERIOD3 = "";
    const EMAILPERIOD4 = "";
    //
    //E Payment Reason Code
    //Accept Trans.
    const REASON_SUCCESS = 100;
    const REASON_AUTHORIZE_SUCCESS = 110;
    //Review Trans.
    const REVIEW_QUESTION_ABOUT_REQUEST = 201;
    const REVIEW_ADDRESS_FAIL_VERIFY = 200;
    const REVIEW_CARD_VERIFY_NUMBER = 230;
    const REVIEW_SMART_AUTHORIZE = 520;
    //Reject Error Cancel Trans.
    const REJECT_FIELD_MISSING = 102;
    const REJECT_ADDRESS_FAIL_VERIFY = 200;
    const REJECT_CARD_EXPIRED = 202;
    const REJECT_CARD_DECLINED = 203;
    const REJECT_INSUFFICIENT_FUNDS = 204;
    const REJECT_CARD_STOLEN = 205;
    const REJECT_BANK_UNAVAILABLE = 207;
    const REJECT_CARD_INACTIVE = 208;
    const REJECT_CREDIT_LIMIT_REACHED = 210;
    const REJECT_VALIFICATION_NO_INVALID = 211;
    const REJECT_NEGATIVE_FILE = 221;
    const REJECT_ACC_FROZEN = 222;
    const REJECT_CARD_VERIFY_NUMBER = 230;
    const REJECT_ACC_NO_INVALID = 231;
    const REJECT_CARD_TYPE_NOT_ACCEPTED = 232;
    const REJECT_ISSUE_WITH_REQUEST = 233;
    const REJECT_ABOUT_CONFIGURATION = 234;
    const REJECT_PROCESSOR_FAILURE_OCCURRED = 236;
    const REJECT_CARD_TYPE_INVALID = 240;
    const REJECT_CUSTOMER_NOT_AUTHENTICATED = 476;
    const REJECT_PAYER_AUTHENTICATION = 475;
    //ERROR trans.
    const ERROR_GENERAL_SYS_ERR = 150;
    const ERROR_SRV_TIMEOUT_OCCUR = 151;
    const ERROR_SYS_NOT_FINISH_IN_TIME = 152;
    const ERROR_TIMEOUT_PAYMENT_PROCESSOR = 153;

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
            array(
                'maxCode',
                'safe'),
            array(
                ' paymentYear, paymentMonth, startDate, endDate',
                'safe',
                'on' => 'search'),
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

            'orders' => array(
                self::MANY_MANY,
                'Order',
                'order_group_to_order(orderGroupId, orderId)'
            ),
            'child' => array(
                self::BELONGS_TO,
                'OrderGroup',
                array(
                    'orderGroupId' => 'parentId')),
            'supNotPay' => array(
                self::BELONGS_TO,
                'OrderGroup',
                array(
                    'orderGroupId' => 'mainId',
                ),
                'on' => 'status=0'),
            'supNotPays' => array(
                self::HAS_MANY,
                'OrderGroup',
                array(
                    'mainId',
                ),
                'on' => 'status<3'),
            'sup' => array(
                self::HAS_MANY,
                'OrderGroup',
                array(
                    'mainId')
            ),
            'supPay' => array(
                self::HAS_MANY,
                'OrderGroup',
                array(
                    'mainId'),
                'on' => 'status > 2'
            ),
            'fur' => array(
                self::HAS_MANY,
                'OrderGroup',
                array(
                    'mainFurnitureId')),
            'sendWorks' => array(
                self::HAS_MANY,
                'OrderGroupSendWork',
                array(
                    'orderGroupId')),
            'parent' => array(
                self::BELONGS_TO,
                'OrderGroup',
                array(
                    'parentId' => 'orderGroupId')),
            'sp' => array(
                self::HAS_MANY,
                'UserSpacialProject',
                array(
                    'orderGroupId')),
            'orderGroupToOrders' => array(
                self::HAS_MANY,
                'OrderGroupToOrder',
                'orderGroupId'),
            'orderGroupFiles' => array(
                self::HAS_MANY,
                'OrderGroupFile',
                'orderGroupId'),
            'user' => array(
                self::BELONGS_TO,
                'User',
                'userId'),
//				'shippingDistrict'=>array(
//					self::BELONGS_TO,
//					'District',
//					'shippingDistrictId'),
            'paymentAmphur' => array(
                self::BELONGS_TO,
                'Amphur',
                'paymentAmphurId'),
            'paymentDistrict' => array(
                self::BELONGS_TO,
                'District',
                'paymentDistrictId'),
            'paymentProvince' => array(
                self::BELONGS_TO,
                'Province',
                'paymentProvinceId'),
            'shippingAmphur' => array(
                self::BELONGS_TO,
                'Amphur',
                'shippingAmphurId'),
            'shippingProvince' => array(
                self::BELONGS_TO,
                'Province',
                'shippingProvinceId'),
            'supplier' => array(
                self::BELONGS_TO,
                'Supplier',
                'supplierId'),
//				'orderGroupFiles'=>array(
//					self::HAS_MANY,
//					'OrderGroupFile',
//					'orderGroupId'),
//				'orderGroupToOrders'=>array(
//					self::HAS_MANY,
//					'OrderGroupToOrder',
//					'orderGroupId'),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array(
//code here
        ));
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
     * @return OrderGroup the static model class
     */
    public function getReasonCode($reasonCode)
    {
        switch ($reasonCode) {
            case self::REASON_SUCCESS ://User
                return "100 : Successful transaction.";
                break;
            case self::REASON_AUTHORIZE_SUCCESS ://User
                return "110 : Authorization was partially approved.";
                break;
            case self::REVIEW_QUESTION_ABOUT_REQUEST://User
                return "201 : The issuing bank has questions about the request. You cannot receive an authorization code in the
API reply, but you may receive one verbally by calling the processor.
Possible action: Call your processor or the issuing bank to obtain a verbal authorization code. For
contact phone numbers, refer to your merchant bank information.";
                break;
            case self::REVIEW_ADDRESS_FAIL_VERIFY://User
                return "200 : The authorization request was approved by the issuing bank but declined by CyberSource because it
did not pass the Address Verification Service (AVS) check. Possible action: You can capture the authorization, but consider reviewing the order for possible fraud.";
                break;
            case self::REVIEW_CARD_VERIFY_NUMBER://User
                return "230 : The authorization request was approved by the issuing bank but
declined by CyberSource because it
did not pass the card verification number check.";
                break;
            case self::REVIEW_SMART_AUTHORIZE://User
                return "520 : The authorization request was approved by the issuing bank but declined by CyberSource based on
your Smart Authorization settings.
Possible action: Do not capture the authorization without further review. Review the ccAuthReply_
avsCode, ccAuthReply_cvCode, and ccAuthReply_authFactorCode fields to determine why
CyberSource rejected the request.";
                break;
            case self::REJECT_FIELD_MISSING://User
                return "102 : One or more fields in the request are missing or invalid.
Possible action: See the reply fields InvalidField0...N and MissingField0...N for the invalid or
missing fields. Resend the request with the correct information. Important In the other API services, this reason code is split between 101 (missing fields) and 102
(invalid fields).";
                break;
            case self::REJECT_CARD_EXPIRED://User
                return "202 : The card is expired.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_DECLINED://User
                return "203 : The card was declined. No other information was provided by the issuing bank.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_INSUFFICIENT_FUNDS://User
                return "204 : The account has insufficient funds.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_STOLEN://User
                return "205 : The card was stolen or lost.
Possible action: Review the customer’s information to determine if you want to request a different";
                break;
            case self::REJECT_BANK_UNAVAILABLE://User
                return "207 : The issuing bank was unavailable.
Possible action: Wait a few minutes and resend the request.";
                break;
            case self::REJECT_CARD_INACTIVE://User
                return "208 : The card is inactive or not authorized for card-not-present transactions.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CREDIT_LIMIT_REACHED://User
                return "210 : The credit limit for the card has been reached.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_VALIFICATION_NO_INVALID://User
                return "211 : The card verification number is invalid.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_NEGATIVE_FILE://User
                return "221 : The customer matched an entry on the processor’s negative file.
Possible action: Review the order and contact the payment processor.";
                break;
            case self::REJECT_ACC_FROZEN://User
                return "222 : The customer’s bank account is frozen.
Possible action: Review the order or request a different form of payment.";
                break;
            case self::REJECT_CARD_VERIFY_NUMBER://User
                return "230 : The authorization request was approved by the issuing bank but
declined by CyberSource because it did not pass the card verification number check.";
                break;
            case self::REJECT_ACC_NO_INVALID://User
                return "231 : The account number is invalid.
Possible action: Request a different card or other form of payment.";
                break;
            case self::REJECT_CARD_TYPE_NOT_ACCEPTED://User
                return "232 : The card type is not accepted by the payment processor.
Possible action: Request a different card or other form of payment, and/or check with CyberSource
Customer Support to make sure that your account is configured correctly.";
                break;
            case self::REJECT_ISSUE_WITH_REQUEST://User
                return "233 : The processor declined the request based on an issue with the request itself.
Possible action: Request a different form of payment.";
                break;
            case self::REJECT_ABOUT_CONFIGURATION://User
                return "234 : There is a problem with your CyberSource merchant configuration.
Possible action: Do not resend the request. Contact Customer Support to correct the configuration problem.";
                break;
            case self::REJECT_PROCESSOR_FAILURE_OCCURRED://User
                return "236 : A processor failure occurred. Possible action: Wait a few minutes and resend the request.";
                break;
            case self::REJECT_CARD_TYPE_INVALID://User
                return "240 : The card type sent is invalid or does not correlate with the credit card number.
Possible action: Ask your customer to verify that the card is really the type indicated in your Web store, and resend the request..";
                break;
            case self::REJECT_CUSTOMER_NOT_AUTHENTICATED://User
                return "476 : The customer cannot be authenticated. Possible action: Review the customer's order..";
                break;
            case self::REJECT_PAYER_AUTHENTICATION://User
                return "475 : The customer is enrolled in payer authentication.
Possible action: Authenticate the cardholder before continuing with the transaction.";
                break;
            case self::ERROR_GENERAL_SYS_ERR://User
                return "150 : Error: General system failure. Possible action: Wait a few minutes and resend the request.";
                break;
            case self::ERROR_SRV_TIMEOUT_OCCUR://User
                return "151 : Error: The request was received, but a server time-out occurred.
This error does not include time-outs between the client and the server.
Possible action: To avoid duplicating the order, do not resend the request until you have reviewed the
order status in the Business Center.";
                break;
            case self::ERROR_SYS_NOT_FINISH_IN_TIME://User
                return "152 : Error: The request was received, but a service did not finish running in time.
Possible action: To avoid duplicating the order, do not resend the request until you have reviewed the
order status in the Business Center.";
                break;
            case self::ERROR_TIMEOUT_PAYMENT_PROCESSOR://User
                return "250 : Error: The request was received, but a time-out occurred with the payment processor.
Possible action: To avoid duplicating the transaction, do not resend the request until you have
reviewed the transaction status in the Business Center.";
                break;
        }
    }

    public function sumOrderLastTwelveMonth()
    {
        $today = date('Y-m-d');
        $lastYear = date('Y-m-d', strtotime($today . ' -12 months'));

        $model = $this->find(array(
            'condition' => 'userId=:userId AND (updateDateTime BETWEEN :lastYear  AND :today)',
            'select' => 'sum(summary) as sumTotal',
            'params' => array(
                ':userId' => Yii::app()->user->id,
                ':today' => $today,
                ':lastYear' => $lastYear,
            ),
        ));

        return isset($model) ? $model->sumTotal : 0;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     * public function search()
     * {
     * }
     */
    public function search()
    {
// @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;

        if (isset($this->searchText) && !empty($this->searchText)) {
            $this->orderNo = $this->searchText;
            $this->type = $this->searchText;
        }


//		throw new Exception(print_r($this->paymentMonth.', '.$this->paymentYear.', '.$this->supplierSelected,true));
        $criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, true, 'OR');
        $criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, true, 'OR');
        $criteria->compare('supplierId', $this->supplierId, true, 'OR');
        $criteria->compare('orderNo', $this->orderNo, true, 'OR');

        $criteria->addCondition(" supplierId = " . $this->supplierId);
//		$criteria->compare('title', $this->title, true, 'OR');

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
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderGroup the static model class
     */
    public function findMaxInvoiceNo($model)
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
        $supplierUser = Supplier::model()->findByPk($model->supplierId);

        $criteria = new CDbCriteria;

        $criteria->select = 'max(RIGHT(invoiceNo,6)) as maxCode';
//		if(isset($supplierUser->redirectURL))
//		{
        if ($supplierUser->supplierId == 1 || $supplierUser->supplierId == 3) {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND (supplierId = 1 OR supplierId = 3) AND paymentMethod = ' . $model->paymentMethod;
        } else if ($supplierUser->supplierId == 4 || $supplierUser->supplierId == 5) {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND (supplierId = 4 OR supplierId = 5) AND paymentMethod = ' . $model->paymentMethod;
        } else {
            $criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND supplierId = ' . $supplierUser->supplierId . ' AND paymentMethod = ' . $model->paymentMethod;
        }
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

    public function findMaxOrderNo($prefix = NULL)
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
//		$criteria = new CDbCriteria;
//
//		$criteria->select = 'max(RIGHT(orderNo,6)) as maxCode';
//		$criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW())';
//        if(isset($supplierId)) {
//            $criteria->condition .= ' AND ';
//        }
//
//		$result = new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));

        $orderGroupModel = OrderGroup::model()->find(array(
            'select' => 'max(RIGHT(orderNo,6)) as maxCode',
            'condition' => 'substr(orderNo,1,2)=:prefix',
            'params' => array(
                ':prefix' => $prefix,
            ),
            'order' => 'orderNo desc',
            'limit' => '1'
        ));

        return isset($orderGroupModel) ? $orderGroupModel->maxCode : 0;
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
        $criteria->addCondition("status > 0");
        $criteria->addCondition(" supplierId = " . $this->supplierId);
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
        $criteria->addCondition(" supplierId = " . $this->supplierId);
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
        $criteria->addCondition(" supplierId = " . $this->supplierId);
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
        $criteria->condition = "status in (2 , 5 , 6 , 7 , 8 , 11 , 12 ,13, 14 ,15 ,16,98,97 ) ";
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare('paymentMethod', $this->paymentMethod, true);
        $criteria->compare("status", ">0");
        $criteria->compare("status", "<99");
//        $criteria->compare('supplierId', $this->supplierId, FALSE, 'AND');
        $criteria->addCondition(" supplierId = " . $this->supplierId);
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
        $criteria->condition = "status > 2 AND paymentDateTime is not NULL";
        $criteria->compare('invoiceNo', $this->invoiceNo, true);
        $criteria->compare('orderNo', $this->orderNo, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telephone', $this->telephone, true);
        $criteria->compare("status", ">1");
        $criteria->addCondition(" supplierId = " . $this->supplierId);
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

    public function genInvNo($model)
    {
//		$prefix = "IV" . UserCompany::model()->getPrefixBySupplierId($model->supplierId);
        $prefix = $model->paymentMethod == 1 ? "IVC" : "IVO";
        $max_code = $this->findMaxInvoiceNo($model);
        $max_code += 1;
        return $prefix . date("Ym") . str_pad($max_code, 6, "0", STR_PAD_LEFT);
    }

    public function genOrderNo($supplierId = null)
    {
        $supplierModel = Supplier::model()->findByPk($supplierId);
        $prefix = $supplierModel->prefix;
        $max_code = intval($this->findMaxOrderNo($prefix));
        $max_code += 1;
        return $prefix . date("Ym") . "-" . str_pad($max_code, 6, "0", STR_PAD_LEFT);
    }

    public function findAllStatus()
    {
        return array(
            self::STATUS_ORDER => $this->showOrderStatus(self::STATUS_ORDER),
            self::STATUS_COMFIRM_TRANSFER => $this->showOrderStatus(self::STATUS_COMFIRM_TRANSFER),
            self::STATUS_APPROVE_TRANSFER => $this->showOrderStatus(self::STATUS_APPROVE_TRANSFER),
            self::STATUS_SUPPLIER_SHIPPING => $this->showOrderStatus(self::STATUS_SUPPLIER_SHIPPING),
        );
    }

    public function showOrderStatus($status)
    {
        switch ($status) {
            case 99:
                return "ชำระเงินไม่สำเร็จ(กรุณาชำระเงินอีกครั้ง)";
                break;
            case 98:
                return "ระหว่างดำเนินการตรวจสอบเครดิต";
                break;
            case 1:
                return "รอการยืนยันโอนเงินจากลูกค้า";
                break;
            case 2:
                return "รอตรวจสอบการโอนเงิน";
                break;
            case 3:
                return "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)";
                break;
            case 4:
                return "ผู้ผลิตกำลังจัดส่งสินค้า";
                break;
        }
    }

    public function calVatValue($total = NULL)
    {
        $total = isset($total) ? $total : $this->totalIncVAT;
        return $total - ($total / (1 + (self::VAT_PERCENT / 100)));
    }

    public function findAllSummaryReport()
    {
// Warning: Please modify the following code to remove attributes that
// should not be searched.
//				throw new Exception(print_r($this->paymentYear.', '.$this->paymentMonth.', '.$this->supplierId,true));
        $criteria = new CDbCriteria;

        if (isset($this->startDate) && isset($this->endDate)) {
            $criteria->addBetweenCondition('paymentDateTime', $this->startDate, $this->endDate, 'AND');
            $this->writeToFile('/tmp/startEndDate', print_r($this->startDate, true));
        } else {
            $criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
            $criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
            $this->writeToFile('/tmp/YearMonth', print_r($this->startDate, true));
        }

        $criteria->compare('supplierId', $this->supplierId, FALSE, "AND");
        $criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
        $criteria->compare("status", ">2");
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

    public function findAllMonthSalesArray()
    {
        $result = array();
        $result[1] = "ม.ค.";
        $result[2] = "ก.พ.";
        $result[3] = "มี.ค.";
        $result[4] = "เม.ย.";
        $result[5] = "พ.ค.";
        $result[6] = "มิ.ย.";
        $result[7] = "ก.ค.";
        $result[8] = "ส.ค.";
        $result[9] = "ก.ย.";
        $result[10] = "ต.ค.";
        $result[11] = "พ.ย.";
        $result[12] = "ธ.ค.";
        return $result;
    }

    public function findTotalSummaryReport()
    {
        $criteria = new CDbCriteria;
        $criteria->select = "sum(summary) as totalSummary";
        if (isset($this->startDate) && isset($this->endDate)) {
            $criteria->addBetweenCondition('paymentDateTime', $this->startDate, $this->endDate, 'AND');
            $this->writeToFile('/tmp/startEndDate', print_r($this->startDate, true));
        } else {
            $criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
            $criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
            $this->writeToFile('/tmp/YearMonth', print_r($this->startDate, true));
        }
        $criteria->compare('supplierId', $this->supplierId, FALSE, "AND");
        $criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
        $criteria->compare("status", ">2");
        $criteria->compare("status", "<> 99");
        return $this->find($criteria)->totalSummary;
    }

    public function findAllYearSalesArray()
    {
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = "YEAR(paymentDateTime) as paymentYear";
        $criteria->compare("status", ">2");
        $criteria->compare("paymentDateTime", "<>''");
        $criteria->group = "YEAR(paymentDateTime)";
        foreach ($this->findAll($criteria) as $item) {
            $result[$item->paymentYear] = $item->paymentYear;
        }
        return $result;
    }

    public function updateSumOrderGroupTotalByOrderGroupId($orderGroupId = NULL)
    {
        $orderGroup = OrderGroup::model()->findByPk($orderGroupId);
        $sumTotal = 0;
        foreach ($orderGroup->orders as $order) {
            foreach ($order->orderItems as $item) {
                $price = ($item->product->calProductPromotionPrice() != 0) ? $item->product->calProductPromotionPrice() : $item->product->calProductPrice();

                $sumTotal += ($price * $item->quantity);
            }
        }
        if (!isset(Yii::app()->user->id)) {
            if ($supplierId == 4) {
                $sumTotal = 0;
            }
            $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $sumTotal);
        } else {
            $sumLastTwelveMonth = OrderGroup::model()->sumOrderLastTwelveMonth();
            $sumAll = $sumTotal + $sumLastTwelveMonth;
            if ($supplierId == 4) {
                $noOfBuy = 0;
                $og = OrderGroup::model()->findAll("supplierId =" . $supplierId . " AND userId=" . Yii::app()->user->id . " AND parentId is null");
                foreach ($og->orders[0]->orderItems as $item) {
                    $noOfBuy += $item->quantity;
                }
                $sumAll = $noOfBuy;
            }
            $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $sumAll);
        }
        $discount = $sumTotal * $discountPercent / 100;
        $grandTotal = $sumTotal - $discount;
        $distributorDiscountPercent = 0;
        $orderGroup->totalIncVAT = number_format($sumTotal, 2);
        $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
        $orderGroup->vatValue = $orderGroup->calVatValue();
        $orderGroup->userId = Yii::app()->user->id;

        if (isset(Yii::app()->user->userType) && Yii::app()->user->userType == 2) {
//edit 3 to other when change policy discount of distributor
            $distributorDiscountPercent += 3;
        }
        $totalPostSupplierRangeDiscount = $grandTotal;
        if ($distributorDiscountPercent > 0) {
            $distributorDiscount = $grandTotal * $distributorDiscountPercent / 100;
            $grandTotal = $grandTotal - $distributorDiscount;
        }

        $orderGroup->discountPercent = $discountPercent;
        $orderGroup->discountValue = number_format($discount, 2);
        if ($distributorDiscountPercent > 0 && isset($distributorDiscount)) {
            $orderGroup->distributorDiscountPercent = $distributorDiscountPercent;
            $orderGroup->distributorDiscount = number_format($distributorDiscount, 2);
            $orderGroup->totalPostDistributorDiscount = number_format($grandTotal, 2);
        }
        $extraDiscountArray = $this->sumExtraDiscount($supplierId, $discountPercent);
        if (isset($extraDiscountArray)) {
            $grandTotal -= $extraDiscountArray["totalExtraDiscount"];
            $orderGroup->extraDiscount = number_format($extraDiscountArray["totalExtraDiscount"], 2);
//			$res["extraDiscountArray"] = $extraDiscountArray;
//			$res['totalPostExtraDiscount'] = number_format($grandTotal, 2);
        }
        $orderGroup->summary = $grandTotal;
        if ($orderGroup->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function findAllPayGinzaMyfile()
    {
        $criteria = new CDbCriteria();
        if (Yii::app()->user->userType != 4) {
            $criteria->select = " (t.totalIncVAT + child1.totalIncVAT + child2.totalIncVAT + child3.totalIncVAT) as total ,t.orderGroupId , t.userId , t.orderNo , t.invoiceNo , t.status , t.createDateTime , t.updateDateTime ";
            $criteria->condition = " t.parentId is null AND t.status = 3 AND t.status >=0  AND t.mainFurnitureId is null AND t.supplierId =" . Yii::app()->user->supplierId;
            $criteria->join = "LEFT JOIN order_group child1 ON child1.parentId = t.orderGroupId ";
            $criteria->join .= "LEFT JOIN order_group child2 ON child2.parentId = child1.orderGroupId ";
            $criteria->join .= "LEFT JOIN order_group child3 ON child3.parentId = child2.orderGroupId ";
        }
//		$criteria->compare("type", 1);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => ' t.updateDateTime DESC ,t.createDateTime DESC',
            ),
            'pagination' => array(
                'pageSize' => 30
            ),
        ));
    }

    public function sumExtraDiscount($supplierId, $supplierDiscountRangePercent, $summary, $orderGroupId)
    {

        $orderGroup = $this->findRootOrderGroup($orderGroupId);
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = "t.orderGroupId as orderGroupId , usp.spacialPercent as spacialPercent , t.summary as summary ";
        $criteria->join = "INNER JOIN user_spacial_project usp ON usp.orderGroupId = t.orderGroupId ";
        $criteria->condition = "usp.status = 2 AND t.supplierId = $supplierId ";
        $criteria->condition .= " AND t.userId =" . Yii::app()->user->id;
        if (isset($orderGroup)) {
            $criteria->condition.= " AND usp.orderGroupId = " . $orderGroup->orderGroupId;
        } else {
            if (isset($orderGroupId)) {
                $criteria->condition.= " AND orderGroupId = " . $orderGroupId;
            }
        }

        $item = $this->find($criteria);
//				throw new Exception(print_r($models,true));
        $extraDiscount = 0;
        if (isset($item)):
//		foreach($models as $item)
//		{
            $spacialValue = ($summary * ((100 - $supplierDiscountRangePercent ) / 100)) * ($item->spacialPercent / 100);
            $result[$item->orderGroupId]["extraDiscountPercent"] = $item->spacialPercent;
            $result[$item->orderGroupId]["extraDiscount"] = $spacialValue;
            $extraDiscount += $spacialValue;
//		}
        endif;

        $result["totalExtraDiscount"] = $extraDiscount;
        if (isset($item) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function findRootOrderGroup($orderGroupId)
    {
        $orderGroup = OrderGroup::model()->findByPk($orderGroupId);
        if (isset($orderGroup)) {
            if (isset($orderGroup->mainId)) {
                $ogId = $orderGroup->mainId;
            } else {
                if (isset($orderGroup->parentId)) {
                    $ogId = $orderGroup->parentId;
                } else {
                    $ogId = $orderGroup->orderGroupId;
                }
            }

            $orderGroup = OrderGroup::model()->findByPk($ogId);

            if (isset($orderGroup->parent)) {
                $orderGroup = OrderGroup::model()->findByPk($orderGroup->parentId);
                if (isset($orderGroup->parent)) {
                    $orderGroup = OrderGroup::model()->findByPk($orderGroup->parentId);
                }
            }
        } else {
            $orderGroup = NULL;
        }

        return $orderGroup;
    }

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                if (isset($this->user->partnerCode) && !empty($this->user->partnerCode)) {
                    $code = $this->user->partnerCode;
                    $codeArray = explode("-", $code);
                    $partnerType = NULL;
                    if (strtolower($codeArray[0]) == "org") {
                        $partnerType = 1;
                    } else if (strtolower($codeArray[0]) == "wow") {
                        $partnerType = 2;
                    } else {
                        $partnerType = 0;
                    }
                    //throw new Exception($this->userId);
                    $this->partnerCode = $this->user->partnerCode;
                    $this->partnerType = $partnerType;

                    $userSale = UserSale::model()->find("userId=" . $this->userId . " and supplierId=" . $this->supplierId);

                    if (!isset($userSale)) {
                        $saleGroup = SaleGroupQueue::model()->find("supplierId=" . $this->supplierId);
                        $saleId = SaleQueue::model()->find("saleGroupQueueId=" . $saleGroup->saleGroupQueueId . " and status=1");
                        $userSale = new UserSale();
                        $userSale->supplierId = $this->supplierId;
                        $userSale->userId = $this->userId;
                        $userSale->saleId = $saleId->employeeId;
                        $userSale->createDateTime = new CDbExpression('NOW()');
                        $sale = $saleId->employeeId;
                        if ($userSale->save()) {
                            $saleGroupQueueId = $saleGroup->saleGroupQueueId;
                            $sortOrder = $saleId->sortOrder;
                            $saleGroup->nextQueue($saleGroupQueueId, $sortOrder);
                        }
                    } else {
                        $sale = $userSale->saleId;
                    }
                    $this->saleId = $sale;
                    //mail to sales.
                    $mailToSale = new EmailSend();
                    $employee = Employee::model()->find("employeeId=" . $sale);
                    $tomail = $employee->email . '@daiigroup.com';
                    $name = $employee->fnTh . ' ' . $employee->lnTh;
                    $customName = $this->firstname . ' ' . $this->lastname;
                    $tel = $this->telephone;
                    $email = $this->email;
                    $mailToSale->mailSaleQueueSupplier($tomail, $name, $customName, $tel, $email);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getPeriod()
    {
        $order = OrderGroup::model()->find("orderGroupId='" . $this->orderGroupId . "'");
        for ($i = 1; $i <= 4; $i++) {
            if (!isset($order->parentId)) {
                break;
            } else {
                $order = OrderGroup::model()->find("orderGroupId='" . $order->parentId . "'");
            }
        }

        return $i;
    }

}
