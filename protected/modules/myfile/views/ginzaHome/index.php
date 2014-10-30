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
					<a class="btn <?php echo ($myfile->status == 1) ? "btn-success" : "btn-primary" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId); ?>">
						<h3><?php echo $myfile->orderItems[0]->product->name; ?><?php if($myfile->status == 1): ?><i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
						</a>
				</div>
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
</div>