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
		if(isset($items)):
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
		else:
			foreach($model->orderItems as $item):
				$cat2Product = Category2ToProduct::model()->find("productId = " . $item->productId);
				?>
				<tr>
					<td><?php
						echo $cat2Product->brandModel->title;
						?></td>
					<td class="cat1"><?php
						echo $cat2Product->category->title;
						?></td>
					<td class="cat2"><?php
						echo $cat2Product->category2->title;
						?></td>
					<td class="option"><?php
						$productOption = ProductOption::model()->find("productOptionId =" . $item->orderItemOptions[0]->productOptionId);
						echo $productOption->title;
						?></td>
					<td class="price"><?php
						$price = Product::model()->ginzaPriceByCategory1IdAndCategory2Id($cat2Product->category1Id, $cat2Product->category2Id);
						echo number_format($price);
						?></td>
					<td class="quantity"><?php
						echo $item->quantity;
						?></td>
					<td class="total text-right"><?php
						echo number_format($price * $item->quantity);
						$summary+=$price * $item->quantity;
						?></td>
				</tr>
				<?php
			endforeach;
		endif;
		?>
	</tbody>
	<tfoot>
		<tr style="color: red;font-weight: bold;">
			<td colspan="6" class="text-right">รวม</td>
			<td class="text-right" style="font-size: 24px"><?php echo number_format($summary); ?></td>
		</tr>
	</tfoot>
</table>