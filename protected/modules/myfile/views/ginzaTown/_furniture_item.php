<h3><?php echo $furniture->furnitureGroup->title; ?></h3>
<?php foreach($furniture->furnitureItems as $item): ?>
	<div class="col-lg-3">
		<a onclick="showFurnitureItemSub(<?php echo $item->furnitureItemId; ?>)">
			<img src="<?php echo Yii::app()->baseUrl . $item->image; ?>" style="width: 70%" /></a><br>
		<?php echo $item->title; ?>
	</div>
<?php endforeach; ?>
<br>
<hr>
<div class="row">
	<div class="col-lg-12">
		<h3><span id='planName'><?php echo $furniture->furnitureItems[0]->title; ?></span> Plan</h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-lg-offset-4" id='planImage'>

		<img src="<?php echo Yii::app()->baseUrl . $furniture->furnitureItems[0]->plan; ?>" style="width: 100%" />
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12" id="furnitureItemSub">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>Code</th>
					<th>Picture</th>
					<th>Description</th>
					<th>Q'ty</th>
					<th>Unit</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($furniture->furnitureItems[0]->furnitureItemSubs as $sub): ?>
					<tr>
						<td><?php echo $sub->code; ?></td>
						<td><img src="<?php echo Yii::app()->baseUrl . $sub->image; ?>" style="width: 100%" /></td>
						<td><?php echo $sub->description; ?></td>
						<td><?php echo $sub->quantity; ?></td>
						<td><?php echo $sub->unit; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>



	</div>
</div>
<div class="row wizard-control">
	<div class="pull-right">
		<!--<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php // echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderGroupId")                    ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>-->
		<a id="furniture3Back" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> กลับ</a>
		<a id="furniture3Next" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</a>
	</div>
</div>
