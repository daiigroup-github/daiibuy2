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
		<?php foreach($furnitureItem->furnitureItemSubs as $sub): ?>
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