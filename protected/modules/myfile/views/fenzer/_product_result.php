

<table class="edit-table table table-hover" style="background-color: #DDD" >
	<!--style="text-align: center;background-color: #67ae73"-->
	<thead >
		<tr>
			<th>ประเภทของรั้ว</th>
			<th>ความสูง</th>
			<th>Span</th>
			<th>คุณลักษณะ</th>
			<th>สี</th>
			<th>ราคา/เมตร</th>
			<th class="edit-table-price">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($productResult as $item): ?>
			<tr class="clickableRow" id="<?php echo $item->categoryId; ?>" name="<?php echo $item->description; ?>">
				<td><?php echo $item->title; ?></td>
				<td><?php echo $item->description; ?></td>
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