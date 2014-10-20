<div class="form-group" >
	<div class="col-md-2" style="text-align: center;height: 120px;">
		<?php
		if(isset(Yii::app()->user->id))
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
		}
		$urlLogo = Yii::app()->baseUrl . "/images/daii_logo.png";
		if($model->status < 4 || Yii::app()->controller->action->id == "viewOrder")
		{
			if(isset(Yii::app()->user->id))
			{
				if($user->type == 3 && $model->status <> 3)
				{
					if(isset($supplier->logo) && !empty($supplier->logo))
					{
						echo CHtml::image(Yii::app()->baseUrl . "/" . $supplier->logo, '', array(
							'style'=>'width:120px;'));
					}
					else
					{
						echo CHtml::image(Yii::app()->baseUrl . "/images/NoLogo.png", '', array(
							'style'=>'width:120px;'));
					}
				}
				else
				{
					if(isset($supplier->redirectURL) && (Yii::app()->user->userType != 5 && Yii::app()->user->userType != 1))
					{

						echo CHtml::image(Yii::app()->baseUrl . "/" . $supplier->logo, '', array(
							'style'=>'width:120px;'));
					}
					else
					{
						echo CHtml::image($urlLogo, '', array(
							'style'=>'width:120px;'));
					}
				}
			}
		}
		else
		{
			if(isset(Yii::app()->user->id))
			{

				if(isset($supplier->redirectURL) && Yii::app()->user->userType != 5 && Yii::app()->user->userType != 1)
				{
					if(isset($supplier->logo) && !empty($supplier->logo))
					{
						echo CHtml::image(Yii::app()->baseUrl . "/" . $supplier->logo, '', array(
							'style'=>'width:120px;'));
					}
					else
					{
						echo CHtml::image(Yii::app()->baseUrl . "/images/NoLogo.png", '', array(
							'style'=>'width:120px;'));
					}
				}
				else
				{

					echo CHtml::image($urlLogo, '', array(
						'style'=>'width:120px;'));
				}
			}
			else
			{
				if(isset($supplier->redirectURL) && (Yii::app()->user->userType != 5 && Yii::app()->user->userType != 1))
				{
					echo CHtml::image(Yii::app()->baseUrl . "/" . $supplier->logo, '', array(
						'style'=>'width:120px;'));
				}
				else
				{
					echo CHtml::image($urlLogo, '', array(
						'style'=>'width:120px;'));
				}
			}
		}
		?>
	</div>
	<div class="col-md-6" style="text-align: center;height: 120px;border: 1px #dddddd solid">
		<?php
		if(isset(Yii::app()->user->id))
		{
			if(($model->status < 4 && ($user->type != 2 && $user->type != 3)) && !isset($supplier->redirectURL))
			{
				?>
				<br>
				<?php
				if(isset($daiiAddr))
				{
					echo $daiiAddr->description;
				}
			}
			else
			{
				echo getOrderSupplierBillingAddress($model);
			}
		}
		else
		{
			if(isset($daiiAddr))
			{
				echo $daiiAddr->description;
			}
		}
		?>
	</div>
	<div class="col-md-4" style="text-align: center;height: 120px;border: 1px #dddddd solid">
		<h4 style="margin-top: 43px;"><?php echo (Yii::app()->controller->action->id == "printProductList") ? "ใบรายการสินค้า" : ((Yii::app()->controller->action->id == "viewOrder" && $user->type == 3) ? "ใบสั่งซื้อสินค้า" : $pageText[$model->status]['pageTitle']); ?></h4>
	</div>
</div>
<div class="form-group" >
	<?php
	$numberOfTax = Configuration::model()->getTaxNumber();
	if(isset($user))
	{
		if($model->status != 3 && ($user->type != 4 || $user->type != 2 ))
		{
			?>
			<div class="col-md-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $numberOfTax; ?>
				</h5></div>
			<div class="col-md-6 table-condensed" style="text-align: right" >
				<?php
				if(isset($user))
				{
					if($user->type == 5 || $user->type == 4)
					{
						echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
					}
					else
					{
						echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
					}
				}
				else
				{
					echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
				}
				?>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="col-md-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $numberOfTax; ?>
				</h5></div>
			<div class="col-md-6 table-condensed" style="text-align: right" >
				<?php
				if(isset($user))
				{
					if($user->type == 5 || $user->type == 4)
					{
						echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
					}
					else
					{
						echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
					}
				}
				else
				{
					echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
				}
				?>
			</div>
			<?php
		}
	}
	else
	{
		?>
		<div class="col-md-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $numberOfTax; ?>
			</h5></div>
		<div class="col-md-6 table-condensed" style="text-align: right;font-size:small" >
			<?php
			if(isset($user))
			{
				if($user->type == 5 || $user->type == 4)
				{
					echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
				}
				else
				{
					echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
				}
			}
			else
			{
				echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
			}
			?>
		</div>
	<?php } ?>


</div>