

<table class="edit-table table table-hover" style="background-color: #DDD" >
	<!--style="text-align: center;background-color: #67ae73"-->
	<thead >
		<tr>
			<th>ประเภทของรั้ว</th>
			<th>ความสูง</th>
			<th>Span</th>
			<th>คุณลักษณะ</th>
			<th>สี</th>
<!--			<th>ราคา/เมตร</th>
			<th class="edit-table-price">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>-->
		</tr>
	</thead>
	<tbody>
		<?php
//		throw new Exception(print_r($productResult,true));
		foreach($productResult as $item):
			$cat1 = $item['cat1'];

			$descArray = explode("*", $cat1->description);

			?>
			<tr class="clickableRow" id="<?php echo $item['categoryId']; ?>" name="<?php echo $item['description']; ?>" style="<?php echo $cat1->categoryId; ?>" >
				<td><?php echo $cat1->title ." ". $item['title']; ?></td>
				<td id="cate1Id" name="<?php echo $cat1->categoryId; ?>"><?php echo $item['description']; ?></td>
				<td>3.00</td>
				<td><?php echo $descArray[2]; ?></td>
				<td><?php echo $descArray[1]; ?></td>
<!--				<td>1,711.00</td>
				<td>587</td>-->
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