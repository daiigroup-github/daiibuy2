<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->userId), array(
		'view',
		'id'=>$data->userId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('cart')); ?>:</b>
	  <?php echo CHtml::encode($data->cart); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('wishlist')); ?>:</b>
	  <?php echo CHtml::encode($data->wishlist); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('newsletter')); ?>:</b>
	  <?php echo CHtml::encode($data->newsletter); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	  <?php echo CHtml::encode($data->ip); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	  <?php echo CHtml::encode($data->status); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('approved')); ?>:</b>
	  <?php echo CHtml::encode($data->approved); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	  <?php echo CHtml::encode($data->token); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	  <?php echo CHtml::encode($data->type); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	  <?php echo CHtml::encode($data->createDateTime); ?>
	  <br />

	 */ ?>

</div>