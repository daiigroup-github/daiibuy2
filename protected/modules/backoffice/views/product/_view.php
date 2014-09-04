<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->productId), array(
		'view',
		'id'=>$data->productId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sku')); ?>:</b>
	<?php echo CHtml::encode($data->sku); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upc')); ?>:</b>
	<?php echo CHtml::encode($data->upc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockStatusId')); ?>:</b>
	<?php echo CHtml::encode($data->stockStatusId); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	  <?php echo CHtml::encode($data->image); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('shipping')); ?>:</b>
	  <?php echo CHtml::encode($data->shipping); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	  <?php echo CHtml::encode($data->price); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
	  <?php echo CHtml::encode($data->points); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('taxClassId')); ?>:</b>
	  <?php echo CHtml::encode($data->taxClassId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('dateAvailable')); ?>:</b>
	  <?php echo CHtml::encode($data->dateAvailable); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	  <?php echo CHtml::encode($data->weight); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
	  <?php echo CHtml::encode($data->length); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
	  <?php echo CHtml::encode($data->width); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	  <?php echo CHtml::encode($data->height); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('subtract')); ?>:</b>
	  <?php echo CHtml::encode($data->subtract); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('minimum')); ?>:</b>
	  <?php echo CHtml::encode($data->minimum); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('sortOrder')); ?>:</b>
	  <?php echo CHtml::encode($data->sortOrder); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	  <?php echo CHtml::encode($data->status); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	  <?php echo CHtml::encode($data->createDateTime); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	  <?php echo CHtml::encode($data->updateDateTime); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('viewed')); ?>:</b>
	  <?php echo CHtml::encode($data->viewed); ?>
	  <br />

	 */ ?>

</div>