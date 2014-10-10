

<div class="img-rounded" style="background-color:white; border: 2px; border-color: #dddddd; border-style: solid;">
	<?php
	$this->renderPartial("_header", array(
		'model'=>$model,
//		'user'=>$user,
		'daiiAddr'=>$daiiAddr,
		'pageText'=>$pageText,
	));
	?>
	<?php
	$this->renderPartial("_header_address", array(
		'model'=>$model,
//		'user'=>$user,
	));
	?>
	<?php
	$this->renderPartial("_items", array(
		'model'=>$model,
		'user'=>$user,
	));
	?>
</div>
