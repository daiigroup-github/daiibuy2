<?php
foreach($provinces as $province):
	?>
	<div class="row">
		<div class="col-lg-4"><?php echo $province->provinceName ?></div>
		<div class="col-lg-8"></div>
	</div>
	<?php
endforeach;
?>