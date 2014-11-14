<div class="row sidebar-box blue">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4><?php echo $model->title; ?></h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">
			<div class="row">
				<div class="col-md-5">
					<?php
					echo CHtml::image(Yii::app()->baseUrl . $model->image, $model->title, array(
						'class'=>'col-md-12'))
					?>
				</div>
				<div class="col-md-7">
					<h3>Tile</h3>
					<table class="table table-bordered table-condensed table-hover">
						<tbody>
							<?php foreach($cat2Product as $item): ?>
								<tr>
									<td class="col-md-2"><?php
										echo CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
											'class'=>'col-md-12'));
										?></td>
									<td><?php echo $item->groupName; ?></td>
									<td><?php echo $item->product->name; ?></td>
									<td class="price"><?php echo $item->product->price; ?></td>
									<td><?php echo $item->product->code; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<?php
					if(isset(Yii::app()->user->id)):
						echo CHtml::link('<i class="fa fa-heart-o"></i> Add to wishlist', "", array(
							'class'=>'btn btn-danger pull-right',
							'onClick'=>'addFavourite(' . Yii::app()->user->id . ',' . $model->categoryId . ",'" . Yii::app()->baseUrl . "',true" . ')',));
					else:
						?>
						<div class="pull-right label label-danger">สมาชิกสามารถเพิ่มรายการที่ชื่นชอบได้</div>
					<?php
					endif;
					?>

					<?php
					echo CHtml::link('<i class="icon-back icon-white"></i> กลับ', "", array(
						'class'=>'btn btn-primary pull-right',
						'onclick'=>'history.back()'));
					?>
				</div>
			</div>
		</div>
	</div>

</div>