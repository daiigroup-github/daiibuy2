<?php
$this->breadcrumbs = array(
    $this->module->id,
);
$uid = uniqid(time());
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
                foreach ($styles as $style):
                    ?>
                    <li role="presentation" class="<?php echo ($i == 0) ? 'active' : ''; ?>">
                        <a href="#style_<?php echo $i; ?>" aria-controls="style_<?php echo $i; ?>" role="tab" data-toggle="tab"><?php
                            echo $style->title;
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
                foreach ($styles as $style):
                    $catToSubModels = CategoryToSub::model()->findAll(array(
                        'condition' => 'categoryId=:categoryId AND brandModelId=:brandModelId order by sortOrder',
                        'params' => array(
                            ':categoryId' => $style->categoryId,
                            ':brandModelId' => $brandModelId
                        ),
                    ));
                    ?>
                    <div role="tabpanel" class="tab-pane <?php echo ($i == 0) ? 'active' : ''; ?>" id="style_<?php echo $i; ?>">

                        <?php if (isset($style->description) && !empty($style->description)): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center alert alert-info"><?php echo $style->description; ?></p>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="btn-primary active">
                                    <a href="#<?php echo 'style_' . $i; ?>_0" aria-controls="<?php echo 'style_' . $i; ?>_0" role="tab" data-toggle="tab"><b>All</b></a>
                                </li>
                                <li role="presentation" class="btn-primary">
                                    <a href="#<?php echo 'style_' . $i; ?>_1" aria-controls="<?php echo 'style_' . $i; ?>_1" role="tab" data-toggle="tab"><b>Health</b></a>
                                </li>
                                <li role="presentation" class="btn-primary">
                                    <a href="#<?php echo 'style_' . $i; ?>_2" aria-controls="<?php echo 'style_' . $i; ?>_2" role="tab" data-toggle="tab"><b>A</b></a>
                                </li>
                                <li role="presentation" class="btn-primary">
                                    <a href="#<?php echo 'style_' . $i; ?>_3" aria-controls="<?php echo 'style_' . $i; ?>_3" role="tab" data-toggle="tab"><b>Original</b></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="<?php echo 'style_' . $i; ?>_0">
                                    <?php
                                    foreach ($catToSubModels as $catToSubModel):
                                        if (isset($catToSubModel->subCategory)):
                                            ?>
                                            <div class="col-lg-4" >
                                                <a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId . "/s/" . $style->categoryId); ?>">
                                                    <img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image;
                                            ?>" alt=""/>
                                                    <p><?php echo $catToSubModel->subCategory->title; ?></p>
                                                    <p><?php echo $catToSubModel->subCategory->description; ?></p>
                                                </a>
                                            </div>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="<?php echo 'style_' . $i; ?>_1">
                                    <?php
                                    $haveItem = FALSE;
                                    foreach ($catToSubModels as $catToSubModel):
                                        if (isset($catToSubModel->subCategory)):
                                            $health = (strtolower(substr($catToSubModel->subCategory->title, -6)) == "health") ? 1 : 0;
                                            if ($health) {
                                                $haveItem = true;
                                                ?>
                                                <div class="col-lg-4" >
                                                    <a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId . "/s/" . $style->categoryId); ?>">
                                                        <img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image; ?>" alt=""/>
                                                        <p><?php echo $catToSubModel->subCategory->title; ?></p>
                                                        <p><?php echo $catToSubModel->subCategory->description; ?></p>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        endif;
                                    endforeach;
                                    if (!$haveItem) {
                                        ?>
                                        <div class="col-lg-12 text-center" style="color:red">
                                            <p>-- ไม่มีรายการ --</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="<?php echo 'style_' . $i; ?>_2">
                                    <?php
                                    $haveItem = FALSE;
                                    foreach ($catToSubModels as $catToSubModel):
                                        if (isset($catToSubModel->subCategory)):
                                            $a = (strtolower(substr($catToSubModel->subCategory->title, -1)) == "a") ? 1 : 0;
                                            if ($a) {
                                                $haveItem = true;
                                                ?>
                                                <div class="col-lg-4" >
                                                    <a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId . "/s/" . $style->categoryId); ?>">
                                                        <img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image; ?>" alt=""/>
                                                        <p><?php echo $catToSubModel->subCategory->title; ?></p>
                                                        <p><?php echo $catToSubModel->subCategory->description; ?></p>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        endif;
                                    endforeach;
                                    if (!$haveItem) {
                                        ?>
                                        <div class="col-lg-12 text-center" style="color:red">
                                            <p>-- ไม่มีรายการ --</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="<?php echo 'style_' . $i; ?>_3">
                                    <?php
                                    $haveItem = FALSE;
                                    foreach ($catToSubModels as $catToSubModel):
                                        if (isset($catToSubModel->subCategory)):
                                            $health = (strtolower(substr($catToSubModel->subCategory->title, -6)) == "health") ? 1 : 0;
                                            $a = (strtolower(substr($catToSubModel->subCategory->title, -1)) == "a") ? 1 : 0;
                                            if (!$health && !$a) {
                                                $haveItem = true;
                                                ?>
                                                <div class="col-lg-4" >
                                                    <a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId . "/s/" . $style->categoryId); ?>">
                                                        <img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image; ?>" alt=""/>
                                                        <p><?php echo $catToSubModel->subCategory->title; ?></p>
                                                        <p><?php echo $catToSubModel->subCategory->description; ?></p>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        endif;
                                    endforeach;
                                    if (!$haveItem) {
                                        ?>
                                        <div class="col-lg-12 text-center" style="color:red">
                                            <p>-- ไม่มีรายการ --</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

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