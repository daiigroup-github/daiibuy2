<?php

class TransferDataController extends MasterBackofficeController
{

	public function actionIndex()
	{
		$this->render("index");
	}

	public function actionTransferPurchesedOrderFromDaiibuy1Index()
	{
		$this->checkAdminAccessMenu();
		$model = new OrderDaiibuy1('search');
//		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrderDaiibuy1']))
			$model->attributes = $_GET['OrderDaiibuy1'];

		$this->render('order_index', array(
			'model'=>$model,
		));
	}

	public function actionTransferPurchesedOrder()
	{
		$order = OrderDaiibuy1::model()->findByPk($_GET["orderId"]);
		if(isset($_POST["OrderDaiibuy1"]))
		{
			try
			{
				$flag = true;
				$transaction = Yii::app()->db->beginTransaction();
				$orderGroup = new OrderGroup();
				$orderGroup->userId = $order->userId;
				$orderGroup->supplierId = $_POST["OrderDaiibuy1"]["supplierId"];
				$orderGroup->orderNo = 'OLD_' . $order->orderNo;
				$orderGroup->invoiceNo = 'OLD_' . $order->invoiceNo;
				$orderGroup->firstname = $order->firstname;
				$orderGroup->lastname = $order->lastname;
				$orderGroup->email = $order->email;
				$orderGroup->summary = $order->totalIncVAT - $order->usedPoint;
				$orderGroup->updateDateTime = $order->updateDateTime;
				$orderGroup->status = -1;
				$orderGroup->createDateTime = new CDbExpression('NOW()');

				if(!$orderGroup->save(false))
				{
					$flag = FALSE;
				}
				else
				{
					$order->comment = "Transfer From Daiibuy V.1 By Tong";
					$order->save(false);
				}

				if(!$flag)
				{
					$transaction->rollback();
				}
				else
				{
					$transaction->commit();
					$this->redirect(array(
						'transferPurchesedOrderFromDaiibuy1Index'));
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				throw new Exception($exc->getMessage());
			}
		}
		else
		{
			$order->addError("suppplierId", "กรุณาเลือก Supplier");
		}

		$this->render("orderPurchesed", array(
			'model'=>$order));
	}

	public function actionIsTestData()
	{
		$order = OrderDaiibuy1::model()->findByPk($_GET["orderId"]);
		$order->comment = "Test Data";
		$order->save();

		$this->redirect(array(
			'transferPurchesedOrderFromDaiibuy1Index'));
	}

}

?>