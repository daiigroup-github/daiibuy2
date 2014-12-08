<?php
/* @var $this BankNameController */
/* @var $model BankName */


Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#bank-name-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Transfer Data Index
		<div class="pull-right">
			<?php
			?>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-3">
				1.
			</div>
			<div class="col-lg-9">
				<?php
				echo CHtml::link("Transfer Order", Yii::app()->createUrl("/backoffice/transferData/transferPurchesedOrderFromDaiibuy1Index"), array(
					'class'=>'btn btn-lg btn-primary'
				));
				?>
			</div>
		</div>
	</div>

</div>
