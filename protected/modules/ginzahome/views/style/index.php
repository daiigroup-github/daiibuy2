<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $supplierModel->name; ?></h4>
        </div>

    </div>
    <!-- /Heading -->
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <!--                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>-->
				<?php
				$i = 0;
				foreach($styles as $style):
					?>
					<li role="presentation" class="<?php echo ($i == 0) ? 'active' : ''; ?>">
						<a href="#style_<?php echo $i; ?>" aria-controls="style_<?php echo $i; ?>" role="tab" data-toggle="tab"><?php
							echo $style->category->title;
							;
							?></a>
					</li>
					<?php
					$i++;
				endforeach;
				?>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
				<?php
				$i = 0;
				foreach($styles as $style):
					$catToSubModels = CategoryToSub::model()->findAll(array(
						'condition'=>'categoryId=:categoryId AND brandModelId=:brandModelId',
						'params'=>array(
							':categoryId'=>$style->category->categoryId,
							':brandModelId'=>$brandModelId
						),
					));
					?>
					<div role="tabpanel" class="tab-pane <?php echo ($i == 0) ? 'active' : ''; ?>" id="style_<?php echo $i; ?>">
						<div class="row">
							<?php foreach($catToSubModels as $catToSubModel): ?>
								<div class="col-md-4">
									<a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId); ?>">
										<img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image; ?>" alt=""/>
										<p><?php echo $catToSubModel->subCategory->title; ?></p>
										<p><?php echo $catToSubModel->subCategory->description; ?></p>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php
					$i++;
				endforeach;
				?>
            </div>

        </div>
    </div>
</div>