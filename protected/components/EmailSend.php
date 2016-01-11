<?php

class EmailSend
{ //extends Controller
// Example for send Email
//$this->mailsend("Tong","Tong","kamy_jap@hotmail.com","TEst Test Test","Test Test","SSSSSSSS");
//private $website = Yii::app()->getParams()->websiteUrl;
//private $website = "http://192.168.100.33/intranet-yii";
//private $website = "http://intranet-test.dcorp.co.th"; //

    private $adminEmail = "No-Reply@daiigroup.com";
    private $subject = "No-Reply : ";
    private $userModel;
    private $supplierModel;
    private $suppliers;
    private $dealerModel;
    private $orderModel;
    private $productModel;
    private $admins;
    private $adminFinance;
    private $thai_month_arr = array(
        "0" => "",
        "1" => "มกราคม",
        "2" => "กุมภาพันธ์",
        "3" => "มีนาคม",
        "4" => "เมษายน",
        "5" => "พฤษภาคม",
        "6" => "มิถุนายน",
        "7" => "กรกฎาคม",
        "8" => "สิงหาคม",
        "9" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );

    private function prepareMailInfo($mailObj)
    {

        if (isset($mailObj->userId))
        {
            $user = new User();
            $this->userModel = $user->findByPk($mailObj->userId);
        }
        if (isset($mailObj->dealerId))
        {
            $dealer = new User();
            $this->dealerModel = $dealer->findByPk($mailObj->dealerId);
        }
        if (isset($mailObj->supplierId))
        {
            $this->supplierModel = Supplier::model()->findByPk($mailObj->supplierId);
            $supplierToUser = UserToSupplier::model()->findAll('supplierId = ' . $mailObj->supplierId);
            $i = 0;
            foreach ($supplierToUser as $sup)
            {
                $this->suppliers[$i] = User::model()->findByPk($sup->userId);
                $i++;
            }
        }
        if (isset($mailObj->orderId))
        {
            $order = new OrderGroup();
            $this->orderModel = $order->findByPk($mailObj->orderId);
        }
        if (isset($mailObj->productId))
        {
            $product = new Product();
            $this->productModel = $product->findByPk($mailObj->productId);
        }
        $adminModel = new User();
        $this->admins = $adminModel->findAll("type =:type", array(
            ":type" => 4));

        $adminFinanceModel = new user();
        $this->adminFinance = $adminFinanceModel->findAll("type =:type", array(
            ":type" => 5));
    }

//	public function mailsend($name, $documentTypeName, $documentNo, $email, $documentId, $website, $action = "", $remarks = "", $creator = null) {
//
//		$message = new YiiMailMessage();
//		$message->view = 'document';
//		$message->setBody(array(
//			"name" => $name,
//			"documentTypeName" => $documentTypeName,
//			"documentNo" => $documentNo,
//			"documentUrl" => $website . $documentId,
//			"action" => $action,
//			"remarks" => $remarks,
//			"creator" => $creator), 'text/html', 'utf-8');
//
////$message->message->setBody($body, 'text/html');
////$message->message->setBody($body, 'text/plain','utf-8');
//
//		$message->subject = $this->subject . " " . $documentTypeName . " " . $documentNo;
//		$message->addTo($email);
////$message->from   = ($this->adminEmail);
//		$message->setFrom(array(
//			'No-Reply@daiigroup.com' => 'เอกสาร Intranet'));
//
//		if (Yii::app()->getParams()->sendEmail) {
//			Yii::app()->mail->send($message);
//		}
//
//		/* Yii::app()->user->setFlash('contact',
//		  'Emails sent:'.$email.'\n'.
//		  'Thank you for contacting us. We will respond to you as
//		  soon as possible.');
//		  //$this->refresh(); */
//	}

    public function mailNewAccount($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'newAccount';
        $message->setBody(array(
            "name" => $this->userModel->firstname . " " . $this->userModel->lastname,
            "userName" => $this->userModel->email,
            "password" => $mailObj->remark,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/site/login"), 'text/html', 'utf-8');

        $message->subject = "จดหมายยืนยันการสมัครใช้บริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->userModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//mail to Admin
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'newAccountToAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "userName" => $this->userModel->email,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/user/view/id/" . $this->userModel->userId), 'text/html', 'utf-8');
            $message->subject = "จดหมายแจ้งมีผู้สมัครใหม่ใช้บริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
        /* Yii::app()->user->setFlash('contact',
          'Emails sent:'.$email.'\n'.
          'Thank you for contacting us. We will respond to you as
          soon as possible.');
          //$this->refresh(); */
    }

    public function mailNewSupplierDealer($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'newSupplierDealer';
        $message->setBody(array(
            "name" => $this->userModel->firstname . " " . $this->userModel->lastname,
            "userName" => $this->userModel->email,
            "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

        $message->subject = "จดหมายยืนยันการสมัครใช้บริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->userModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//mail to Admin
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'newAccountToAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "userName" => $this->userModel->email,
                "documentUrl" => $mailObj->documentUrl . $this->userModel->userId), 'text/html', 'utf-8');
            $message->subject = "จดหมายแจ้งมีผู้สมัครใหม่ใช้บริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            var_dump($admin->email);
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailRequestApproveTranferToAdmin($mailObj)
    {
//mail to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailRequestApproveTranferToAdmin';

            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "userName" => $this->orderModel->email,
                "documentUrl" => $mailObj->documentUrl . $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');
        }

        $message->subject = "จดหมายแจ้งมีผู้ซื้อสินค้าซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($admin->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }


        foreach ($this->adminFinance as $adminFinance)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailRequestApproveTranferToAdmin';
            $message->setBody(array(
                "name" => $adminFinance->firstname . " " . $adminFinance->lastname,
                "userName" => $this->orderModel->email,
                "documentUrl" => $mailObj->documentUrl . $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');
            $message->subject = "จดหมายแจ้งมีผู้ซื้อสินค้าซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($adminFinance->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailReviewEPayment($mailObj)
    {
        $this->prepareMailInfo($mailObj);

        if ($this->orderModel->paymentMethod == 1)
        {
            $message = new YiiMailMessage();
            $message->view = 'reviewOrderEPayment';
            $message->setBody(array(
                "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
                "invoiceNo" => $this->orderModel->invoiceNo,
                "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งผลการชำระสินค้าผ่านบัตรเครดิต DaiiBuy.com";
            $message->addTo($this->userModel->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
//mail to Admin

        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'reviewOrderEPaymentAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "userName" => $this->userModel->email,
                "documentUrl" => $mailObj->documentUrl,
                "invoiceNo" => $this->orderModel->invoiceNo), 'text/html', 'utf-8');
            $message->subject = "จดหมายแจ้งมีผู้ซื้อสินค้าซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

        //Finance Admin

        foreach ($this->adminFinance as $adminFinance)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'reviewOrderEPaymentFinanceAdmin';
            $message->setBody(array(
                "name" => $adminFinance->firstname . " " . $adminFinance->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo,
                "supplierName" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
                "dealerName" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งผู้ดูแลระบบ กรุณาตรวจสอบเอกสารประกอบการจ่ายเงิน";
            $message->addTo($adminFinance->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailCompleteOrderCustomer($mailObj)
    {
        $this->prepareMailInfo($mailObj);

        if ($this->orderModel->paymentMethod == 1)
        {
            $message = new YiiMailMessage();
            $message->view = 'completeOrderCustomer';
            $message->setBody(array(
                "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
                "invoiceNo" => $this->orderModel->invoiceNo,
                "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

            $message->subject = "จดหมายยืนยันการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($this->userModel->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
        elseif ($this->orderModel->paymentMethod == 2)
        {
            $message = new YiiMailMessage();
            $message->view = 'completeOrderCustomer';
            $message->setBody(array(
                "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
                "invoiceNo" => $this->orderModel->invoiceNo,
                "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

            $message->subject = "จดหมายยืนยันการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
//			throw new Exception(print_r($this->orderModel->email,true));
            $message->addTo($this->userModel->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
//mail to Admin

        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'completeOrderCustomerToAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "userName" => $this->userModel->email,
                "documentUrl" => $mailObj->documentUrl,
                "invoiceNo" => $this->orderModel->invoiceNo), 'text/html', 'utf-8');
            $message->subject = "จดหมายแจ้งมีผู้ซื้อสินค้าซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailConfirmOrderSupplierDealer($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'completeOrderSupplierDealer';

        $message->setBody(array(
            "name" => $this->supplierModel->name,
            "customerName" => $this->orderModel->firstname . " " . $this->orderModel->lastname,
            "invoiceNo" => $this->orderModel->invoiceNo,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderGroupId), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        foreach ($this->suppliers as $sup)
        {
            $message->addTo($sup->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

//to dealer
//		$message->setBody(array(
//			"name"=>isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
//			"customerName"=>$this->orderModel->firstname . " " . $this->orderModel->lastname,
//			"invoiceNo"=>$this->orderModel->invoiceNo,
//			"documentUrl"=>$mailObj->documentUrl,
//			"orderID"=>$this->orderModel->orderGroupId), 'text/html', 'utf-8');
//		$message->addTo($this->dealerModel->email);
//		$message->setFrom(array(
//			'No-Reply@daiibuy.com'=>'แจ้งเตือน DaiiBuy'));
//		if(Yii::app()->getParams()->sendEmail)
//		{
//			Yii::app()->mail->send($message);
//		}
    }

    public function mailAddNewProductCompleted($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'addNewProductCompleted';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "productName" => $this->productModel->name,
            "productMargin" => $this->productModel->margin->value,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/",
            "productID" => $this->productModel->productId), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งการเพิ่มสินค้า ระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailAddNewProductEdit($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'addNewProductEdit';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "productName" => $this->productModel->name,
            "remark" => $mailObj->remark,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/",
            "productID" => $this->productModel->productId), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งการเพิ่มสินค้า ระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailAddNewProductRejected($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'addNewProductRejected';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "productName" => $this->productModel->name,
            "remark" => $mailObj->remark,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/",
            "productID" => $this->productModel->productId), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งการเพิ่มสินค้า ระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailAddNewProductEditedToAdmin($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {

            $message = new YiiMailMessage();
            $message->view = 'addNewProductEditedToAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "productName" => $this->productModel->name,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/",
                "productID" => $this->productModel->productId), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งการเพิ่มสินค้า ระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
            $message = null;
        }
    }

    public function mailAddNewProductToAdmin($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {

            $message = new YiiMailMessage();
            $message->view = 'addNewProductToAdmin';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "supplierName" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
                "productName" => $this->productModel->name,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/",
                "productID" => $this->productModel->productId), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งการเพิ่มสินค้า ระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
            $message = null;
        }
    }

    public function thai_date($time)
    {
        $thai_date_return = "วันที่ " . date("j", $time);
        $thai_date_return.=" " . $this->thai_month_arr[date("n", $time)];
        $thai_date_return.= " " . (date("Y", $time) + 543);
        $thai_date_return.= "  " . date("H:i", $time) . " น.";
        return $thai_date_return;
    }

    public function mailReturnProductToSupplier($mailObj)
    {
        //admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailReturnProduct';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
                "orderID" => $this->orderModel->orderId,
                "remark" => $mailObj->remark,
                "invoiceNo" => $this->orderModel->orderNo,
                "supplierName" => $this->supplierModel->businessAddress->company,
                "dealerName" => $this->dealerModel->businessAddress->company), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

        //supplier
    }

    public function mailReadyToShipToCustomer($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailVerifyCodeToCustomer';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo,
            "dealerName" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "dealerAddress" => isset($this->dealerModel->businessAddress->address_1) ? $this->dealerModel->businessAddress->address_1 : "",
            "dealerAddress2" => isset($this->dealerModel->businessAddress->address_2) ? $this->dealerModel->businessAddress->address_2 : "",
            "amphur" => $this->dealerModel->businessAddress->amphur->amphurName,
            "province" => $this->dealerModel->businessAddress->province->provinceName,
            "postcode" => $this->dealerModel->businessAddress->postcode,
            "email" => $this->dealerModel->email,
            "dealerPhone" => isset($this->dealerModel->telephone) ? $this->dealerModel->telephone : "",
            //"shippingDateTime" => $this->thai_date(strtotime($this->orderModel->supplierShippingDateTime)),
            "verifyCode" => $this->orderModel->verifyCode), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->orderModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailReadyToShipProduct($mailObj)
    {
//to Customer
//		$this->prepareMailInfo($mailObj);
//		$message = new YiiMailMessage();
//		$message->view = 'mailVerifyCodeToCustomer';
//		$message->setBody(array(
//			"name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
//			"documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
//			"orderID" => $this->orderModel->orderId,
//			"invoiceNo" => $this->orderModel->orderNo,
//			"dealerName" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
//			"dealerAddress" => isset($this->dealerModel->businessAddress->address_1) ? $this->dealerModel->businessAddress->address_1 : "",
//			"dealerAddress2" => isset($this->dealerModel->businessAddress->address_2) ? $this->dealerModel->businessAddress->address_2 : "",
//			"dealerPhone" => isset($this->dealerModel->telephone) ? $this->dealerModel->telephone : "",
//			"shippingDateTime" => $this->thai_date(strtotime($this->orderModel->supplierShippingDateTime)),
//			"verifyCode" => $this->orderModel->verifyCode), 'text/html', 'utf-8');
//
//		$message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
//		$message->addTo($this->orderModel->email);
//		$message->setFrom(array(
//			'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
//		if (Yii::app()->getParams()->sendEmail)
//		{
//			Yii::app()->mail->send($message);
//		}
//to dealer
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'readyToShipProduct';
        $message->setBody(array(
            "name" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo,
            "shippingDateTime" => $this->thai_date(strtotime($this->orderModel->supplierShippingDateTime))), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->dealerModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'readyToShipProduct';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo,
                "shippingDateTime" => $this->thai_date(strtotime($this->orderModel->supplierShippingDateTime))), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailDealerRecievedProduct($mailObj)
    {

//to Customer
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailVerifyCodeToCustomer';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "dealerName" => $this->dealerModel->firstname,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo,
            "verifyCode" => $this->orderModel->verifyCode), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->orderModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Supplier
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'dealerRecievedProduct';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'dealerRecievedProduct';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/",
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailCustomerRecievedProduct($mailObj)
    {
//to Customer
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'customerThank';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "invoiceNo" => $this->orderModel->orderNo,
            "orderID" => $this->orderModel->orderId,
            "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

        $message->subject = "ขอบคุณที่ใช้บริการสั่งซื้อสินค้าผ่านบริก ารระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->orderModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
//$message = null;
            $message = new YiiMailMessage();
            $message->view = 'customerReceivedConfirm';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

//to supplier
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'customerReceivedConfirm';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailRequestCustomerConfirmTranfer($mailObj)
    {
//to Customer
        $this->prepareMailInfo($mailObj);
        $bankList = Bank::model()->findAll("supplierId = " . $this->orderModel->supplierId . " and status = 1");
        $message = new YiiMailMessage();
        $message->view = 'mailRequestCustomerConfirmTranfer';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "invoiceNo" => $this->orderModel->orderNo,
            "orderID" => $this->orderModel->orderId,
            "documentUrl" => $mailObj->documentUrl . $this->orderModel->orderId,
            "bankList" => $bankList), 'text/html', 'utf-8');
        $message->addTo($this->orderModel->email);

        $message->subject = "ขอบคุณที่ใช้บริการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";

        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            if (Yii::app()->mail->send($message))
            {
                $rere = true;
            }
        }
    }

    public function mailUserConfirmRecievedProduct($mailObj)
    {
//to Customer
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'verifyRecievedFromCustomer';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "invoiceNo" => $this->orderModel->orderNo,
            "orderID" => $this->orderModel->orderId,
            "documentUrl" => $mailObj->documentUrl . "/token/" . md5($this->orderModel->verifyCode)), 'text/html', 'utf-8');

        $message->subject = "ขอบคุณที่ใช้บริการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->orderModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            if (Yii::app()->mail->send($message))
            {
                $rere = true;
            }
        }

//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'customerReceivedNotConfirm';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

//to supplier
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'customerReceivedNotConfirm';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to dealer
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'customerReceivedNotConfirm';
        $message->setBody(array(
            "name" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->dealerModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailRequestAdminToApproveSupplierDealerDocument($mailObj)
    {
//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailAdminToApproveSupplierDealerDocument';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo,
                "supplierName" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
                "dealerName" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งผู้ดูแลระบบ กรุณาตรวจสอบเอกสารประกอบการจ่ายเงิน";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }

        foreach ($this->adminFinance as $adminFinance)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailAdminToApproveSupplierDealerDocument';
            $message->setBody(array(
                "name" => $adminFinance->firstname . " " . $adminFinance->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo,
                "supplierName" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
                "dealerName" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งผู้ดูแลระบบ กรุณาตรวจสอบเอกสารประกอบการจ่ายเงิน";
            $message->addTo($adminFinance->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailToSupplierToReuploadDocument($mailObj)
    {
//to supplier
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'mailSupplierReuploadDucument';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งผู้ผลิตสินค้ากรุณาตรวจสอบข้อมูลและทำการอัพโหลดใหม่";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailToDealerToReuploadDocument($mailObj)
    {
//to dealer
        $this->prepareMailInfo($mailObj);
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'mailDealerReuploadDucument';
        $message->setBody(array(
            "name" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งตัวแทนกระจายสินค้ากรุณาตรวจสอบข้อมูลและทำการอัพโหลดใหม่";
        $message->addTo($this->dealerModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailRequestSupplierDealerComeToBilling($mailObj)
    {
        $this->prepareMailInfo($mailObj);

//to dealer
        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'mailRequestSupplierDealerComeToBilling';
        $message->setBody(array(
            "name" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งตัวแทนกระจายสินค้ากรุณาตรวจสอบข้อมูลและทำการอัพโหลดใหม่";
        $message->addTo($this->dealerModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Supplier

        $message = null;
        $message = new YiiMailMessage();
        $message->view = 'mailRequestSupplierDealerComeToBilling';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "orderID" => $this->orderModel->orderId,
            "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งผู้ผลิตสินค้ากรุณาตรวจสอบข้อมูลและทำการอัพโหลดใหม่";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }

//to Admin
        $this->prepareMailInfo($mailObj);
        foreach ($this->admins as $admin)
        {
            $message = null;
            $message = new YiiMailMessage();
            $message->view = 'mailApproveSupplierDealerDocument';
            $message->setBody(array(
                "name" => $admin->firstname . " " . $admin->lastname,
                "documentUrl" => $mailObj->documentUrl,
                "orderID" => $this->orderModel->orderId,
                "invoiceNo" => $this->orderModel->orderNo), 'text/html', 'utf-8');

            $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
            $message->addTo($admin->email);
            $message->setFrom(array(
                'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
            if (Yii::app()->getParams()->sendEmail)
            {
                Yii::app()->mail->send($message);
            }
        }
    }

    public function mailConfirmPaymentToSupplier($mailObj)
    {
//to Supplier
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailConfirmPaySupplierAndSlip';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailWarningSupplierProductQuantity($mailObj)
    {
//to Supplier
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailWarningSupplierProductQuantity';
        $message->setBody(array(
            "name" => isset($this->supplierModel->businessAddress->company) ? $this->supplierModel->businessAddress->company : $this->supplierModel->firstname . " " . $this->supplierModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "qty" => $mailObj->remark,
            "productId" => $mailObj->productId,
            "productName" => $this->productModel->name), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งเตือนปริมาณสินค้าคงคลังเหลือน้อย";
        $message->addTo($this->supplierModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailConfirmPaymentToDealer($mailObj)
    {
//to Dealer
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailConfirmPayDealerAndSlip';
        $message->setBody(array(
            "name" => isset($this->dealerModel->businessAddress->company) ? $this->dealerModel->businessAddress->company : $this->dealerModel->firstname . " " . $this->dealerModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "slipImg" => $mailObj->remark), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งความคืบหน้าการส่งสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
        $message->addTo($this->dealerModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailSentNewPwdToUser($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailSentNewPwdToUser';
        $message->setBody(array(
            "name" => $this->userModel->firstname . " " . $this->userModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "newPwd" => $mailObj->remark,
            "email" => $this->userModel->email), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งรหัสผ่าน ระบบซื้อสินค้าออนไลน์ daiiBuy.com";
        $message->addTo($this->userModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

    public function mailSentNewPwdToNewUser($mailObj)
    {
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailSentNewPwdToNewUser';
        $message->setBody(array(
            "name" => $this->userModel->firstname . " " . $this->userModel->lastname,
            "documentUrl" => $mailObj->documentUrl,
            "newPwd" => $mailObj->remark,
            "email" => $this->userModel->email), 'text/html', 'utf-8');

        $message->subject = "จดหมายแจ้งรหัสผ่าน ระบบซื้อสินค้าออนไลน์ daiiBuy.com";
        $message->addTo($this->userModel->email);
        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            Yii::app()->mail->send($message);
        }
    }

//	public function mailRequestCustomerConfirmTranfer($mailObj)
//	{
////to Customer
//		$this->prepareMailInfo($mailObj);
//		$message = new YiiMailMessage();
//		$message->view = 'mailRequestCustomerConfirmTranfer';
//		$message->setBody(array(
//			"name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
//			"invoiceNo" => $this->orderModel->orderNo,
//			"orderID" => $this->orderModel->orderId,
//			"documentUrl" => $mailObj->documentUrl . $this->orderModel->orderId), 'text/html', 'utf-8');
//		$message->addTo($this->orderModel->email);
//
//		$message->subject = "ขอบคุณที่ใช้บริการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";
//
//		$message->setFrom(array(
//			'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
//		if (Yii::app()->getParams()->sendEmail)
//		{
//			if (Yii::app()->mail->send($message))
//			{
//				$rere = true;
//			}
//		}
//	}

    public function mailRejectConfirmTransferToCustomer($mailObj)
    {
//to Customer
        $this->prepareMailInfo($mailObj);
        $message = new YiiMailMessage();
        $message->view = 'mailRejectConfirmToCustomer';
        $message->setBody(array(
            "name" => $this->orderModel->paymentFirstname . " " . $this->orderModel->paymentLastname,
            "invoiceNo" => $this->orderModel->orderNo,
            "orderID" => $this->orderModel->orderGroupId,
            "documentUrl" => $mailObj->documentUrl . $this->orderModel->orderGroupId,
            "remark" => $mailObj->remark), 'text/html', 'utf-8');
        $message->addTo($this->orderModel->email);

        $message->subject = "ขอบคุณที่ใช้บริการสั่งซื้อสินค้าผ่านบริการระบบซื้อสินค้าออนไลน์ DaiiBuy.com";

        $message->setFrom(array(
            'No-Reply@daiibuy.com' => 'แจ้งเตือน DaiiBuy'));
        if (Yii::app()->getParams()->sendEmail)
        {
            if (Yii::app()->mail->send($message))
            {
                $rere = true;
            }
        }
    }

}
