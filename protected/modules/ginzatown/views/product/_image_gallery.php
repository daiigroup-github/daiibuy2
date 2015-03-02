<div class = "row">

    <!--Carousel Heading -->
    <div class = "col-lg-12 col-md-12 col-sm-12">

        <div class = "carousel-heading">
            <h4><?php echo 'Gallery';?></h4>
        </div>

    </div>
    <!--/Carousel Heading -->

    <div class = "col-lg-12 col-md-12 col-sm-12">
        <div class="row">
            <div class="col-md-8">
                <div class="thumbnail">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/ginzahome/1floor.jpg" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/ginzahome/1floor.jpg" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/ginzahome/1floor.jpg" />
                </div>
            </div>
        </div>
        <div class="row">
            <?php for($i=0; $i<3; $i++):?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/ginzahome/1floor.jpg" />
                </div>
            </div>
            <?php endfor;?>
        </div>
    </div>
</div>

<?php
// $this->renderPartial('_vdo');
?>