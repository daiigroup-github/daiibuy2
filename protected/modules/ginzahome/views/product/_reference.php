<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="row">

        <!--Carousel Heading -->
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="carousel-heading">
                <h4><?php echo 'Reference' . $i; ?></h4>
            </div>

        </div>
        <!--/Carousel Heading -->

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="thumbnail">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/ginzahome/2floor.jpg"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/ginzahome/2floor.jpg"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/ginzahome/2floor.jpg"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.co.th/maps/ms?msa=0&amp;msid=210674205032286146553.0004e84c41361ecb86f98&amp;ie=UTF8&amp;ll=13.767718,100.56605&amp;spn=0.196756,0.136884&amp;t=m&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php endfor; ?>