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
					<div class="row">
						<?php
						$i = 1;
						foreach($cat2Product as $item):
							?>
							<div class="col-md-2" style="border: 1px blue solid;padding: 0px">
								<div class="text-center" style="border: 1px blue solid ;width:100%;margin: 0px 0px 0px 0px"><?php echo $i; ?></div>
								<div style="width: 100%"><?php
									echo CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
										'style'=>'width:100%'));
									?></div>
								<div style="font-size: x-small;background-color: blue;color: white" class="text-center"><?php echo $item->product->code; ?></div>
							</div>
							<?php
							$i++;
						endforeach;
						for($i; $i <= 12; $i++)
						{
							?>
							<div class="col-md-2" style="border: 1px blue solid;padding: 0px">
								<div class="text-center" style="border: 1px blue solid ;width:100%;margin: 0px 0px 0px 0px"><?php echo $i; ?></div>
								<div style="width: 100%;height: 109px">&nbsp;<?php
//									echo CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
//										'style'=>'width:100%'));
									?></div>
								<div style="font-size: x-small;background-color: blue;color: white" class="text-center">&nbsp;</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<?php ?>
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