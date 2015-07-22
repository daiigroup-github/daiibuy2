<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<?php //$this->renderPartial("_navbar");  ?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4>My Files GINZA HOME</h4>
        </div>

    </div>
    <!-- /Heading -->
</div>

<div class="tabs">
    <div class="tab-heading">
		<?php
		echo CHtml::link("กำลังดำเนินการ" . ' ', '#tab1', array(
			'class'=>'button big'));
		?>
		<?php
		echo CHtml::link("ชำระเงินครบ" . ' ', '#tab2', array(
			'class'=>'button big'));
		?>
    </div>
    <div class="page-content tab-content">
        <div id="tab1">
            <div class="row">
				<?php $i = 0; ?>
				<?php foreach($myfileArray as $myfile): ?>
					<?php
					$sum = 0;
					$isComplete = FALSE;
					if($myfile->child->child->child->status == -1)
					{
						foreach($myfile->child->child->child->sup as $sup)
						{
							$sum += $sup->totalIncVAT;
						}

						if($sum == $myfile->child->child->child->totalIncVAT)
						{
							$isComplete = TRUE;
						}
					}
					else
					{
						if($myfile->child->child->child->status > 2)
						{
							$isComplete = TRUE;
						}
						else
						{
							$isComplete = FALSE;
						}
					}

					if($isComplete)
					{
						continue;
					}
					?>
					<div class='col-lg-3 col-md-3 col-sm-12'>
						<div class="blog-item">
							<a class="btn <?php echo ($myfile->status > 2) ? (($isComplete) ? "btn-success" : "btn-primary") : "btn-warning" ?> col-md-12" href="<?php echo Yii::app()->createUrl('/index.php/myfile/ginzaHome/view/id/' . $myfile->orderGroupId); ?>">
	<?php
	if(isset($myfile->orders[0]->orderItems[0]->product->productImagesSort[0])):
		echo CHtml::image(Yii::app()->baseUrl . $myfile->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array());
	else:
		echo CHtml::image(Yii::app()->baseUrl . "/images/no-image.jpg", "", array());
	endif;
	?>
								<h3><?php echo $myfile->orderNo; ?><?php if(1 == 0): ?>
										<i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
							<!--<p>วันที่สร้าง :<?php // echo $this->dateThai($myfile->createDateTime, 3, TRUE);               ?></p>-->
								<p>วันที่แก้ไขล่าสุด :<?php echo $this->dateThai($myfile->updateDateTime, 3, TRUE) ?></p>

								<p style="font-size: 17px">
	<?php /* if ($isComplete): ?>
	  <span class="label label-warning"><i class="fa fa-home"></i> ชำระเงินครบแล้ว<i class="fa fa-check"></i></span>
	  <?php //else: ?>
	  <span class="label label-warning"><i class="fa fa-home"></i> รอชำระเงิน<i class='fa fa-remove'></i></span>
	  <?php endif; */ ?>
					<?php if(isset($myfile->fur[0])): ?>
										<span class="label label-danger">Furniture <?php echo ($myfile->fur[0]->status > 2) ? " ชำระแล้ว<i class='fa fa-check'></i>" : " รอชำระเงิน<i class='fa fa-remove'></i>" ?></span>

	<?php endif; ?>
								</p>

							</a>

						</div>
					</div>
					<?php $i++; ?>
				<?php endforeach; ?>
            </div>
        </div>

        <div id="tab2">
            <div class="row">
				<?php $i = 0; ?>
				<?php foreach($myfileArray as $myfile): ?>
					<?php
					$sum = 0;
					$isComplete = FALSE;
					if($myfile->child->child->child->status == -1)
					{
						foreach($myfile->child->child->child->sup as $sup)
						{
							$sum += $sup->totalIncVAT;
						}

						if($sum == $myfile->child->child->child->totalIncVAT)
						{
							$isComplete = TRUE;
						}
					}
					else
					{
						if($myfile->child->child->child->status > 2)
						{
							$isComplete = TRUE;
						}
						else
						{
							$isComplete = FALSE;
						}
					}

					if(!$isComplete)
					{
						continue;
					}
					?>
					<div class='col-lg-3 col-md-3 col-sm-12'>
						<div class="blog-item">
							<a class="btn <?php echo ($myfile->status > 2) ? (($isComplete) ? "btn-success" : "btn-primary") : "btn-warning" ?> col-md-12" href="<?php echo Yii::app()->createUrl('/index.php/myfile/ginzaHome/view/id/' . $myfile->orderGroupId); ?>">
									<?php
									if(isset($myfile->orders[0]->orderItems[0]->product->productImagesSort[0])):
										echo CHtml::image(Yii::app()->baseUrl . $myfile->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array());
									else:
										echo CHtml::image(Yii::app()->baseUrl . "/images/no-image.jpg", "", array());
									endif;
									?>
								<h3><?php echo $myfile->orderNo; ?><?php if(1 == 0): ?>
										<i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
							<!--<p>วันที่สร้าง :<?php // echo $this->dateThai($myfile->createDateTime, 3, TRUE);                ?></p>-->
								<p>วันที่แก้ไขล่าสุด :<?php echo $this->dateThai($myfile->updateDateTime, 3, TRUE) ?></p>

								<p style="font-size: 17px">
	<?php /* if ($isComplete): ?>
	  <span class="label label-warning"><i class="fa fa-home"></i> ชำระเงินครบแล้ว<i class="fa fa-check"></i></span>
	  <?php else: ?>
	  <span class="label label-warning"><i class="fa fa-home"></i> รอชำระเงิน<i class='fa fa-remove'></i></span>
	  <?php endif; */ ?>
	<?php if(isset($myfile->fur[0])): ?>
										<span class="label label-danger">Furniture <?php echo ($myfile->fur[0]->status > 2) ? " ชำระแล้ว<i class='fa fa-check'></i>" : " รอชำระเงิน<i class='fa fa-remove'></i>" ?></span>

	<?php endif; ?>
								</p>

							</a>

						</div>
					</div>
	<?php $i++; ?>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


