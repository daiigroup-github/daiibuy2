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
					<a href="<?php echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/myfiles/' . $myfile->title . '.png'); ?>
						<div class="button blue" style="text-align: center;background-clip: border-box;color: white" name="<?php echo $myfile->title; ?>"><?php echo $myfile->title; ?></div>
					</a>
				</div>
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
</div>