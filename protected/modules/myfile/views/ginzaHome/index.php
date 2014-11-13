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
					<a class="btn <?php echo ($myfile->status == 3) ? "btn-success" : "btn-primary" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/ginzaHome/view/id/' . $myfile->orderGroupId); ?>">
						<?php
						echo CHtml::image(Yii::app()->baseUrl . $myfile->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array())
						?>
						<h3><?php echo $myfile->orderNo; ?><?php if($myfile->status == 3): ?><i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
						<p>วันที่สร้าง :<?php echo $this->dateThai($myfile->createDateTime, 3, TRUE); ?></p>
						<p>วันที่แก้ไข :<?php echo $this->dateThai($myfile->updateDateTime, 2, TRUE) ?></p>
					</a>

				</div>
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
</div>