<table class="table table-bordered table-condensed">
	<thead>
		<tr>
			<th>Model</th>
			<th>Category</th>
			<th>Series</th>
			<th>Color</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$summary = 0;
		foreach($items as $k=> $item):
			if(intval($k) > 0):
				?>
				<tr>
					<td><?php
						echo $item["brandModelTitle"];
						?></td>
					<td class="cat1"><?php
						echo $item["category1Title"];
						?></td>
					<td class="cat2"><?php
						echo $item["category2Title"];
						?></td>
					<td class="option"><?php
						echo $item["productOptionTitle"];
						?></td>
					<td class="price"><?php
						echo number_format($item["price"]);
						?></td>
					<td class="quantity"><?php
						echo $item["quantity"];
						?></td>
					<td class="total text-right"><?php
						echo number_format($item["total"]);
						$summary+=$item["total"];
						?></td>
				</tr>
				<?php
			endif;
		endforeach;
		?>
	</tbody>
	<tfoot>
		<tr style="color: red;font-weight: bold;">
			<td colspan="6" class="text-right">รวม</td>
			<td class="text-right" style="font-size: 24px"><?php echo number_format($summary); ?></td>
		</tr>
	</tfoot>
</table>