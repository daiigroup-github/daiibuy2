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
					echo CHtml::image(Yii::app()->baseUrl . $myfile->orders[0]->orderItems[0]->product->image, "", array())
					?>
					<a class="btn <?php echo ($myfile->status == 3) ? "btn-success" : "btn-primary" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/ginzahome/view/id/' . $myfile->orderGroupId); ?>">
						<h3><?php echo $myfile->orderNo; ?><?php if($myfile->status == 3): ?><i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
					</a>
				</div>
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
</div>