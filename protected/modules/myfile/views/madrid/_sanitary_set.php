<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Product Image</th>
			<th>Code</th>
			<th>Title/Category</th>
			<th>Price</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($model as $item): ?>
			<tr>
				<td><?php echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image) : ""; ?></td>
				<td><?php echo $item->product->code; ?></td>
				<td><?php echo $item->product->name . "<br>" . $item->category2->title; ?></td>
				<td style="color:red"><?php echo number_format($item->product->price, 2); ?>
					<?php echo CHtml::hiddenField("Order[createMyfileType]", 3) ?>
					<?php echo CHtml::hiddenField("OrderItems[$item->productId][productId]", $item->productId) ?>
					<?php echo CHtml::hiddenField("OrderItems[$item->productId][price]", $item->product->price) ?>
				</td>
				<td style="width: 20%">
					<div class="row"><div class="col-md-12"><?php echo CHtml::numberField("OrderItems[$item->productId][quantity]") ?></div></div>
					<div class="row"><div class="col-md-12">
							<?php
							echo CHtml::link("<i class='icon-cart'></i>Add TO CART", "", array(
								'class'=>'button orange btn-xs'))
							?>
						</div></div>
					<div class="row">
						<div class="col-md-12">
							<?php
							echo CHtml::link("<i class='icon-trash'></i>REMOVE", "", array(
								'class'=>'button btn-xs'))
							?>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	//the id of the 'Copy' link in the view, see below.
	'id'=>'copyItem',
	//add a icon image tag instead of the text
	//leave empty to disable removing
	'removeText'=>'<i class="fa fa-remove"></i>',
	//htmlOptions of the remove link
	'removeHtmlOptions'=>array(
//		'style'=>'color:red',
		'class'=>'btn btn-danger'
	),
	//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
	'options'=>array(
		//A class to attach to each copy
		'copyClass'=>'newCopy',
		// The number of allowed copies. Default: 0 is unlimited
		'limit'=>0,
		//Option to clear each copies text input fields or textarea
		'clearInputs'=>true,
		//A jQuery selector used to exclude an element and its children
		'excludeSelector'=>'.skipcopy',
	//Additional HTML to attach at the end of each copy.
//		'append'=>CHtml::tag('span', array(
//			'class'=>'hint'
//			), 'You can remove this line'),
	),
	'jsAfterNewId'=>"
		if(typeof this.attr('name') !== 'undefined'){ this.attr('name', this.attr('name').replace('[]', '['+counter+']'));}

		",
));
?>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Brand</th>
					<th>Model</th>
					<th>Cat1</th>
					<th>Cat2</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Unit</th>
					<th>Price/Unit</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<tr class="copyRow" id="copyRow">
					<td><?php
						echo CHtml::dropDownList("OrderItems[brandId][]", "", Brand::model()->getAllBrandBySupplierId(3), array(
							'prompt'=>'Select Brand',
							'class'=>'form-control',
							'onchange'=>"findModel(this,'" . Yii::app()->baseUrl . "');",
							'id'=>'brandId',
						));
						?></td>
					<td class="model"><?php
						echo CHtml::dropDownList('OrderItems[brandModelId][]', '', array(
							), array(
							'prompt'=>'Select Model',
							'class'=>'form-control',
							'onchange'=>"findCat1(this,'" . Yii::app()->baseUrl . "');",
							'id'=>'brandModelId',
						));
						?></td>
					<td class="cat1"><?php
						echo CHtml::dropDownList('OrderItems[category1Id][]', '', array(
							), array(
							'prompt'=>'Select Cat1',
							'class'=>'form-control',
							'onchange'=>"findCat2(this,'" . Yii::app()->baseUrl . "');",
							'id'=>'category1Id',
						));
						?></td>
					<td class="cat2"><?php
						echo CHtml::dropDownList('OrderItems[category2Id][]', '', array(
							), array(
							'prompt'=>'Select Cat2',
							'class'=>'form-control',
							'onchange'=>"findProduct(this,'" . Yii::app()->baseUrl . "');",
							'id'=>'category2Id',
						));
						?></td>
					<td class="product"><?php
						echo CHtml::dropDownList('OrderItems[productId][]', '', array(
							), array(
							'prompt'=>'Select Product',
							'class'=>'form-control',
							'id'=>'productId',
						));
						?></td>
					<td><?php
						echo CHtml::numberField('OrderItems[quantity][]', "", array(
							'class'=>'form-control'))
						?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6"><a id="copyItem" href="#" rel=".copyRow">Copy</a></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>