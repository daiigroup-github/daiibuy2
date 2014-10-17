<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mail
 *
 * @author pth
 */
class Email
{

	public $documentUrl;
	public $productId;
	public $orderId;
	public $userId;
	public $supplierId;
	public $dealerId;
	public $remark;

//	private function setID($ID) {
//		$this->ID = $ID;
//	}
//	private function getCustomerEmail() {
//		return $this->customerEmail;
//	}
//
//	private function getSuplierEmail() {
//		return $this->suplierEmail;
//	}
//
//	private function getDealerEmail() {
//		return $this->dealerEmail;
//	}
//
//	private function getCustomerEmail() {
//		return $this->customerEmail;
//	}
//	public function __set($name, $value) {
//		switch ($name) { //this is kind of silly example, bt shows the idea
//			case 'ID':
//				return $this->setID($value);
//		}
//	}
//	public function __get($name) {
//		switch ($name) {
//			case 'customerEmail':
//				return $this->getCustomerEmail();
//			case 'suplierEmail':
//				return $this->getCustomerEmail();
//			case 'dealerEmail':
//				return $this->getDealerEmail();
//		}
//	}
	//put your code here
	public function Setmail($userId = null, $dealerId = null, $supplierId = null, $orderId = null, $productId = null, $documentUrl = null, $remark = null)
	{
		$this->userId = $userId;
//		$this->dealerId = $dealerId;
		$this->supplierId = $supplierId;
		$this->orderId = $orderId;
		$this->productId = $productId;
		$this->documentUrl = $documentUrl;
		$this->remark = $remark;
//		$dealerName= null,
//			$productName= null, $productId= null, $productMargin= null, $invoiceNo= null, $orderId= null,
//			$documentUrl= null, $userName= null, $password= null, $generateCode= null) {
////		$this->customerEmail = $customerEmail;
//		$this->suplierEmail = $suplierEmail;
//		$this->dealerEmail = $dealerEmail;
//		$this->adminEmail = $adminEmail;
//		$this->customerName = $customerName;
//		$this->suplierName = $suplierName;
//		$this->dealerName = $dealerName;
//		$this->productName = $productName;
//		$this->productId = $productId;
//		$this->productMargin = $productMargin;
//		$this->invoiceNo = $invoiceNo;
//		$this->orderId = $orderId;
//		$this->documentUrl = $documentUrl;
//		$this->userName = $userName;
//		$this->password = $password;
//		$this->generateCode = $generateCode;
	}

}

?>
