<?php $this->renderPartial("_navbar"); ?>

<div class="myfile-main">
	<?php
	$this->renderPartial("_wizard_step_fur", array(
		'model'=>$model));
	?>
	<div class="row setup-content" id="step1">
		<?php // foreach() ?>
	</div>
	<div class="row setup-content" id="step2">

	</div>
	<div class="row setup-content" id="step3">

	</div>
</div>