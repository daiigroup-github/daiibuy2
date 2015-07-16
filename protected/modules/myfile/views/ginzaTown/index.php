<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<?php $this->renderPartial("_navbar"); ?>
<div class="row">
	<div style="margin-top: 2%">
		<?php $i = 0; ?>
		<?php foreach($myfileArray as $myfile): ?>
			<div class='col-lg-3 col-md-3 col-sm-12'>
				<div class="blog-item">
					<?php
					$sum = 0;
					$isComplete = FALSE;
					if($myfile->child->child->status == -1)
					{
						foreach($myfile->child->child->sup as $sup)
						{
							$sum+=$sup->totalIncVAT;
						}

						if($sum == $myfile->child->child->totalIncVAT)
						{
							$isComplete = TRUE;
						}
					}
					else
					{
						if($myfile->child->child->status > 2)
						{
							$isComplete = TRUE;
						}
						else
						{
							$isComplete = FALSE;
						}
					}
					?>
					<a class="btn <?php echo ($myfile->status > 2) ? (($isComplete) ? "btn-success" : "btn-primary") : "btn-warning" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/ginzaTown/view/id/' . $myfile->orderGroupId); ?>">
						<?php
						if(isset($myfile->orders[0]->orderItems[0]->product->productImagesSort[0])):
							echo CHtml::image(Yii::app()->baseUrl . $myfile->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array());
						else:
							echo CHtml::image(Yii::app()->baseUrl . "/images/no-image.jpg", "", array());
						endif;
						?>
						<h3><?php echo $myfile->orderNo; ?><?php if(1 == 0): ?><i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
						<!--<p>วันที่สร้าง :<?php // echo $this->dateThai($myfile->createDateTime, 3, TRUE);                          ?></p>-->
						<p>วันที่แก้ไขล่าสุด :<?php echo $this->dateThai($myfile->updateDateTime, 3, TRUE) ?></p>
						<p style="font-size: 17px">
							<?php if($isComplete): ?>
								<span class="label label-warning"><i class="fa fa-home"></i> ชำระเงินครบแล้ว<i class="fa fa-check"></i></span>
							<?php else: ?>
								<span class="label label-warning"><i class="fa fa-home"></i> รอชำระเงิน<i class='fa fa-remove'></i></span>
							<?php endif; ?>
							<?php if($myfile->isRequestSpacialProject): ?>
								<span class="label label-danger">Spacial <?php echo (isset($myfile->sp[0]) && $myfile->sp[0]->status > 1) ? " อนุมัติแล้ว<i class='fa fa-check'></i>" : " รอการอนุมัติ<i class='fa fa-remove'></i>" ?></span>

							<?php endif; ?>
						</p>

					</a>

				</div>
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
</div>