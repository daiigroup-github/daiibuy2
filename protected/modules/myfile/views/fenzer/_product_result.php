

<table class="table table-hover" style="text-align: center;background-color: #67ae73">
	<thead >
		<tr>
			<th style="text-align: center">ประเภทของรั้ว</th>
			<th style="text-align: center">ความสูง</th>
			<th style="text-align: center">Span</th>
			<th style="text-align: center">คุณลักษณะ</th>
			<th style="text-align: center">สี</th>
			<th style="text-align: center">ราคา/เมตร</th>
			<th style="text-align: center;width:17%">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($productResult as $item): ?>
			<tr class="clickableRow" id="<?php echo $item->productId; ?>" name="<?php echo $item->height; ?>">
				<td><?php echo $item->name; ?></td>
				<td><?php echo $item->height; ?></td>
				<td>3.00</td>
				<td>เรียบ 1 ด้าน</td>
				<td>สีคอนกรีตธรรมชาติ</td>
				<td>1,711.00</td>
				<td>587</td>
			</tr>
		<?php endforeach; ?>
<!--		<tr class="clickableRow">
<td>M-Wall</td>
<td>2.25</td>
<td>3.00</td>
<td>เรียบ 1 ด้าน</td>
<td>สีคอนกรีตธรรมชาติ</td>
<td>1,711.00</td>
<td>587</td>
</tr>
<tr class="clickableRow">
<td>M-Wall</td>
<td>2.25</td>
<td>3.00</td>
<td>เรียบ 1 ด้าน</td>
<td>สีคอนกรีตธรรมชาติ</td>
<td>1,711.00</td>
<td>587</td>
</tr>
<tr class="clickableRow">
<td>M-Wall</td>
<td>2.25</td>
<td>3.00</td>
<td>เรียบ 1 ด้าน</td>
<td>สีคอนกรีตธรรมชาติ</td>
<td>1,711.00</td>
<td>587</td>
</tr>-->
	</tbody>
</table>