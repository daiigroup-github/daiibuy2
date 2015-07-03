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
                        <thead>
                            <tr>
                                <th>
                                    รูปสินค้า
                                </th>
                                <th>

                                </th>
                                <th>
                                    รายละเอียด
                                </th>
                                <th>
                                    ราคาที่อื่น บ./ตรม.
                                </th>
                                <th>
                                    ราคามาดริด บ./กล่อง
                                </th>
                                <th>
                                    ราคามาดริด บ./ตรม.
                                </th>
                                <th>
                                    รหัสสินค้า
                                </th>
                            </tr>
                        </thead>
                        <tbody>
							<?php foreach($cat2Product as $item): ?>
								<tr>
									<td class="col-md-3"><div class="product-image"><?php
											echo CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
												'class'=>'col-md-12'));
											?>
											<a href="<?php echo $this->createUrl('product/index/id/' . $item->product->productId); ?>" class="product-hover" style="margin-top: -60px">
												<i class="icons icon-eye-1"></i> Quick View
											</a></div>
									</td>
									<td><?php echo $item->groupName; ?></td>
									<td><?php echo $item->product->name; ?></td>
									<?php $price = isset($item->product->productPromotion->price) ? $item->product->productPromotion->price : $item->product->price; ?>
									<td class="price"><?php echo isset($item->product->otherPrice) ? number_format($item->product->otherPrice * (1.00 / $item->product->area), 2) : "##NONE##"; ?> </td>
									<td class="price"><?php echo number_format($price, 2); ?> </td>
									<td class="price"><?php echo $item->product->area > 0 ? number_format($price * (1.00 / $item->product->area), 2) : "##NONE##"; ?> </td>
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
						echo CHtml::link('<i class="fa fa-heart-o"></i> เก็บเข้า Myfile', "", array(
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