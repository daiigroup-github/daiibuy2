<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php require_once 'tpl_header.php'; ?>
	<div class="container">
		<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Panel heading</div>
				<!-- List group -->
				<?php
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'list-group'),
					'itemCssClass'=>'list-group-item',
				));
				?>
			</div>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9">
			<?php echo $content;?>
		</div>
	</div>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/navbar-fixed-top.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css'); ?>
<?php $this->endContent(); ?>