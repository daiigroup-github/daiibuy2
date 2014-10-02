<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of supplierReportController
 *
 * @author pth
 */
class ReportController extends MasterBackofficeController
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			);
	}

	public function allowedActions()
	{
		return '';
	}

	//put your code here

	public function actionIndex()
	{
		$this->render('index');
//		$model = Order::model()->getNotpaySupplierOrder();
//
//		$dp = new CActiveDataProvider('Order', array(
//			'criteria' => array(
//				'order' => 'supplierId, asc',
//			),
//			'sort' => false,
//			'pagination' => array(
//				'pagesize' => 30,
//			),
//		));
//
//		$this->render('index', array(
//			'model' => $model, 'dp' => $dp
//		));
	}

	public function actionClearSupplierPayment($supplierId)
	{

		$this->redirect(array(
			"//admin/report/adminUploadSupplierSlip/id/" . $supplierId));
	}

	public function actionAdminUploadSupplierSlip($id)
	{
		$this->SupplierUploadSlipFile($id, 3);
	}

	public function SupplierUploadSlipFile($id, $userType)
	{
		$orderFile = new OrderFile();
		$bt = new BalanceTransaction();
		$userPayTo = User::model()->findByPk($id);
		if(isset($_POST["OrderFile"]))
		{
			$orderDP = Order::model()->findOrderBySupplierId($id);
			$listData = $orderDP->getData();

			foreach($listData as $data)
			{
				$order = Order::model()->findByPk($data->orderId);
				if($order->orderStatusid == 11)
				{
					//update status from 11
					$order->orderStatusid = 12;
					$order->save();
				}
				else if($order->orderStatusid == 13)
				{
					//update status from 13
					$order->orderStatusid = 14;
					$order->save();
					// Send mail to Supplier and dealer for confirm payment
				}
			}

			$bt->attributes = $_POST["BalanceTransaction"];
			$bt->userId = $id;
			$bt->userType = $userType;
			$bt->firstname = $userPayTo->firstname;
			$bt->lastname = $userPayTo->lastname;
			$bt->adminFinanceId = Yii::app()->user->id;
			$bt->transactionType = 4;
			$sumTotal = Order::model()->getSumOrderBySupplierTransferd($id);
			$bt->total = $sumTotal["totals"];
			$bt->totalIncVat = $sumTotal["totals"];
			$bt->creatDatetime = new CDbExpression("NOW()");

			$image = CUploadedFile::getInstanceByName("OrderFile[filePath]");
			if(!empty($image))
			{
				$ran = rand(0, 999999);
				$imgType = explode(".", $image->name);
				$imgType = $imgType[count($imgType) - 1];
				$imageUrl = "images/balance_transaction_file/" . $id . "/" . time() . '-' . $ran . "." . $imgType;
				$imagePath = '/../' . $imageUrl;
				$Img = $imageUrl;
				//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
				if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/balance_transaction_file/$id"))
				{
					mkdir(Yii::app()->getBasePath() . '/../' . "images/balance_transaction_file/$id", 0777);
				}

				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$bt->file = $Img;
				//$bt->fileName = CUploadedFile::getInstanceByName("OrderFile['fileName']");
			}
			else
			{
				$bt->file = null;
//				$bt->fileName = null;
			}

			$bt->save();

			$orderDP = Order::model()->findOrderBySupplierIdTransfered($id);
			$listData = $orderDP->getData();

			foreach($listData as $data)
			{
				$bt_items = new BalanceTransactionItems();
				$bt_items->balanceTransactionId = $bt->Id;
				$bt_items->orderId = $data->orderId;
				$bt_items->total = $data->total - $data->marginToDaii;
				$bt_items->totalIncVat = $data->total - $data->marginToDaii;
				$bt_items->createDateTime = new CDbExpression("NOW()");

				$bt_items->save();

				$order = Order::model()->findByPk($data->orderId);

				if($order->orderStatusid == 14 || $order->orderStatusid == 12)
					$order->orderStatusid = 15;
				else if($order->orderStatusid == 16)
					$order->orderStatusid = 17;
				$order->save();
			}
			//sent mail to Supplier
			$emailObj = new Email();
			$sentMail = new EmailSend();
			$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $order->orderId;
			$remark = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/" . $Img;
			$emailObj->Setmail(null, null, $order->supplierId, null, null, $documentUrl, $remark);
			$sentMail->mailConfirmPaymentToSupplier($emailObj);

			$this->redirect(array(
				"//admin/report/ViewSupplierReport"));
		}
		$this->render("_upload_file", array(
			"orderFileModel"=>$orderFile,
			"btModel"=>$bt,
			"supplierName"=>$userPayTo->firstname . " " . $userPayTo->lastname,
		));
	}

	public function actionClearDealerPayment($dealerId)
	{


		$this->redirect(array(
			"//admin/report/adminUploadDealerSlip/id/" . $dealerId));
	}

	public function actionAdminUploadDealerSlip($id)
	{
		$this->DealerUploadSlipFile($id, 2);
	}

	public function DealerUploadSlipFile($id, $userType)
	{
		$orderFile = new OrderFile();
		$bt = new BalanceTransaction();
		$userPayTo = User::model()->findByPk($id);

		if(isset($_POST["OrderFile"]))
		{
			$orderDP = Order::model()->findOrderByDealerId($id);
			$listData = $orderDP->getData();

			foreach($listData as $data)
			{
				$order = Order::model()->findByPk($data->orderId);
				if($order->orderStatusid == 11)
				{
					//update status from 11
					$order->orderStatusid = 13;
					$order->save();
				}
				else if($order->orderStatusid == 12)
				{
					//update status from 13
					$order->orderStatusid = 14;
					$order->save();
					// Send mail to Supplier and dealer for confirm payment
				}
			}

			$bt->attributes = $_POST["BalanceTransaction"];
			$bt->userId = $id;
			$bt->userType = $userType;
			$bt->firstname = $userPayTo->firstname;
			$bt->lastname = $userPayTo->lastname;
			$bt->adminFinanceId = Yii::app()->user->id;
			$bt->transactionType = 4;
			$sumTotal = Order::model()->getSumOrderByDealerTransferd($id);
			$bt->total = $sumTotal['totals'];
			$bt->totalIncVat = $sumTotal['totals'];
			$bt->creatDatetime = new CDbExpression("NOW()");

			$image = CUploadedFile::getInstanceByName("OrderFile[filePath]");
			if(!empty($image))
			{
				$ran = rand(0, 999999);
				$imgType = explode(".", $image->name);
				$imgType = $imgType[count($imgType) - 1];
				$imageUrl = "images/balance_transaction_file/" . $id . "/" . time() . '-' . $ran . "." . $imgType;
				$imagePath = '/../' . $imageUrl;
				$Img = $imageUrl;
				//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
				if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/balance_transaction_file/$id"))
				{
					mkdir(Yii::app()->getBasePath() . '/../' . "images/balance_transaction_file/$id", 0777);
				}

				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$bt->file = $Img;
				//$bt->fileName = CUploadedFile::getInstanceByName("OrderFile['fileName']");
			}
			else
			{
				$bt->file = null;
//				$bt->fileName = null;
			}

			$bt->save();

			$orderDP = Order::model()->findOrderByDealerIdTransfered($id);
			$listData = $orderDP->getData();


			foreach($listData as $data)
			{
				$order = Order::model()->findbypk($data->orderId);
				$bt_items = new BalanceTransactionItems();
				$bt_items->balanceTransactionId = $bt->Id;
				$bt_items->orderId = $data->orderId;
				$bt_items->total = $data->marginToDealer;
				$bt_items->totalIncVat = $data->marginToDealer - ( $data->marginToDealer * 0.03 );
				$bt_items->createDateTime = new CDbExpression("NOW()");

				$bt_items->save();

				if($order->orderStatusid == 13 || $order->orderStatusid == 14)
					$order->orderStatusid = 16;
				else if($order->orderStatusid == 15)
					$order->orderStatusid = 17;
				$order->save();
			}

			//sent mail to Dealer
			$emailObj = new Email();
			$sentMail = new EmailSend();
			$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/";
			$remark = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/" . $order->orderId;
//			var_dump($remark);
			$emailObj->Setmail(null, $order->dealerId, null, null, null, $documentUrl, null);
			$sentMail->mailConfirmPaymentToDealer($emailObj);

			$this->redirect(array(
				"//admin/report/ViewDealerReport"));
		}

		$this->render("_upload_file", array(
			"orderFileModel"=>$orderFile,
			"btModel"=>$bt,
			"supplierName"=>$userPayTo->firstname . " " . $userPayTo->lastname,
		));
	}

	public function actionViewSupplierReport()
	{
		$model = Order::model()->getNotpaySupplierOrder();

		$dp = new CActiveDataProvider('Order', array(
			'criteria'=>array(
				'order'=>'supplierId, asc',
			),
			'sort'=>false,
			'pagination'=>array(
				'pagesize'=>30,
			),
		));

		$this->render('viewSupplierReport', array(
			'model'=>$model,
			'dp'=>$dp
		));
	}

	public function actionViewDealerReport()
	{
		$model = Order::model()->getNotpayDealerOrder();

		$dp = new CActiveDataProvider('Order', array(
			'criteria'=>array(
				'order'=>'dealerId, asc',
			),
			'sort'=>false,
			'pagination'=>array(
				'pagesize'=>30,
			),
		));

		$this->render('viewDealerReport', array(
			'model'=>$model,
			'dp'=>$dp
		));
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'price-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	//Summary Report

	public function actionViewSummaryReport()
	{
		$model = new Order();


		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
		{
			$model->attributes = $_GET['Order'];
		}
		$totalSummary = $model->findTotalSummaryReport();
		if(isset($totalSummary) && intval($totalSummary) > 0)
		{
			$summary = $totalSummary;
		}
		else
		{
			$summary = 0;
		}

		$this->render("viewSummaryReport", array(
			"model"=>$model,
			'totalSummary'=>$summary));
	}

	public function actionCalTotalSummary()
	{

		$result = array();
		$model = new Order();
		if(isset($_GET['Order']))
		{

			$model->attributes = $_GET['Order'];
		}
		$totalSummary = $model->findTotalSummaryReport();
		if(isset($totalSummary))
		{

			$result["status"] = 1;
			$result["totalSummary"] = number_format($totalSummary, 2);
		}
		else
		{
			$result["status"] = 0;
			$result["totalSummary"] = number_format(0, 2);
		}
		echo CJSON::encode($result);
	}

	//Summary Report
}

?>