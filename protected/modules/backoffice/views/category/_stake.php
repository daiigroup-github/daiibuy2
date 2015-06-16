<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
	));
?>
<table class="table table-bordered table-hover">
	<thead>
		<tr class="alert alert-warning">
			<th>จังหวัด</th>
			<th>รายละเอียดเสาเข็ม</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($provinces as $province):
			$stake = CategoryStakeProvince::model()->find("categoryId = $categoryId AND provinceId = $province->provinceId");
			?>
			<tr>
				<td><?php echo isset($province->provinceName) ? $province->provinceName : "" ?></td>
				<td><?php
					echo CHtml::textField("CategoryStakeProvince[$province->provinceId][stake]", isset($stake) ? $stake->stake : "", array(
						'class'=>'col-lg-12'))
					?></td>
			</tr>
			<?php
		endforeach;
		?>
	</tbody>
</table>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-9">
		<?php
		echo CHtml::submitButton('บันทึก', array(
			'class'=>'btn btn-primary'));
		echo CHtml::submitButton('บันทึก และ กลับไปที่ Series', array(
			'class'=>'btn btn-success',
			'name'=>'saveAndBack'));
		?>
	</div>
</div>
<?php $this->endWidget(); ?>