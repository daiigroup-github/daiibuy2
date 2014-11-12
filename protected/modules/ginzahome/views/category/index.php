<?php
/* @var $this ProductController */

$this->breadcrumbs = array(
	'Product',
);
?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $brandModel->title; ?></h4>
        </div>

    </div>
    <!-- /Heading -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">

			<?php foreach($brandModel->categorys as $category): ?>

				<?php
				$category2ToProduct = Category2ToProduct::model()->find("category1Id =" . $category->categoryId);
				if(count($category2ToProduct) > 0):
					?>
					<div class="page-header"><h1><?php echo $category->title; ?> :: Spec</h1></div>
					<div class="row">
						<div class="col-md-4">
							<?php
							echo CHtml::image(Yii::app()->baseUrl . $category->image, $category->title, array(
								'class'=>'pull-right'))
							?>
						</div>
						<div class="col-md-8">
							<h3>Functional</h3>
							<?php echo $category->description; ?>
						</div>

					</div>
					<hr>
					<table class="table table-bordered text-center ginzahome-compare">
						<tr>
							<td>Type</td>
							<?php foreach($category->subCategorys as $subCategory): ?>
								<td style="width: 20%"><?php echo $subCategory->title; ?></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>ราคา</td>

							<?php foreach($category->subCategorys as $subCategory): ?>
								<td style="width: 20%">
									<span class="price">
										<?php
										echo Product::model()->ginzaPriceByCategory1IdAndCategory2Id($category->categoryId, $subCategory->categoryId);
										?>
									</span><br />
									<a class="btn btn-primary form-control" href="<?php echo $this->createUrl('product/index/c/' . $category->categoryId . '/c2/' . $subCategory->categoryId); ?>">เลือก</a>
								</td>
							<?php endforeach; ?>
						</tr>
					</table>
					<hr>
					<?php
				endif;
			endforeach;
			?>





		</div>
	</div>
</div>


<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

