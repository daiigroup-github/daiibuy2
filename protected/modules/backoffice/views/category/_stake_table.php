<table class="table table-bordered table-hover">
	<thead>
		<tr class="alert alert-warning">
			<th>จังหวัด</th>
			<th>รายละเอียดเสาเข็ม</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($provinces as $province):
			$stake = CategoryStakeProvince::model()->find("categoryId = $categoryId AND provinceId = $province->provinceId");
			?>
			<tr>
				<td><?php
					echo isset($province->provinceName) ? $province->provinceName : "";
					?>
				</td>
				<td><?php
					echo CHtml::textField("CategoryStakeProvince[$province->provinceId][stake]", isset($stake) ? $stake->stake : "", array(
						'class' => 'col-lg-12'))
					?></td>
			</tr>
			<?php
		endforeach;
		?>
	</tbody>
</table>