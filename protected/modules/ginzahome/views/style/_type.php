<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="all" class="col-md-8">
    <?php foreach ($catToSubModels as $catToSubModel): ?>
        <div class="col-md-4">
            <a class="thumbnail" href="<?php echo $this->createUrl('category/index/id/' . $catToSubModel->subCategory->categoryId . "/s/" . $style->categoryId); ?>">
                <img src="<?php echo Yii::app()->baseUrl . $catToSubModel->subCategory->image; ?>" alt=""/>
                <p><?php echo $catToSubModel->subCategory->title; ?></p>
                <p><?php echo $catToSubModel->subCategory->description; ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>


<div class="col-lg-12 listing-style3 cruise">
    <div class="gallery-filter box">
        <a href="#" class="button btn-medium active" data-filter="filter-all">All</a>
        <a href="#" class="button btn-medium " data-filter="filter-online">Online</a>
        <a href="#" class="button btn-medium" data-filter="filter-schedule">Schedule</a>
        <a href="#" class="button btn-medium" data-filter="filter-draft">Draft</a>
        <a href="#" class="button btn-medium" data-filter="filter-expired">Expired</a>
    </div>
    <div class="items-container isotope active">
        <?php
        $adss = \common\models\areawow\Ads::find()->all();
        $i = 1;
        foreach ($adss as $ads):
//                                    throw new \yii\base\Exception(strtotime($ads->startDateTime) . " " . strtotime(date("Y-d-m")));
            if (strtotime($ads->startDateTime) <= strtotime(date("Y-d-m")) && strtotime($ads->endDateTime) >= strtotime(date("Y-d-m")) && $ads->status >= 1) {
                $isoClass = " filter-online";
            } else if (strtotime($ads->startDateTime) > strtotime(date("Y-d-m")) && strtotime($ads->endDateTime) >= strtotime($ads->startDateTime) && $ads->status > 1) {
                $isoClass = " filter-schedule";
            } else if ($ads->status == 0) {
                $isoClass = " filter-draft";
            } else {
                $isoClass = " filter-expired";
            }
            ?>
            <article class=" iso-item <?= $isoClass ?> filter-all">
                <figure class="col-sm-4">
                    <a title="" href="#" class="hover-effect"><img width="270" height="160" alt="" src="<?= \yii\helpers\Url::to(Yii::$app->homeUrl . $ads->image); ?>"></a>
                </figure>
                <div class="details col-sm-8">
                    <div class="clearfix">
                        <h4 class="box-title pull-left"><?= $ads->title; ?><small>4 nights</small></h4>
                        <span class="price pull-right"><small>from</small>$239</span>
                    </div>
                    <div class="character date">
                        <div class="col-xs-3 cruise-logo">
                            <i class="soap-icon-clock yellow-color"></i>
                            <div>
                                <span class="skin-color">Start</span><br><?= $ads->startDateTime; ?>
                            </div>
                        </div>
                        <div class="col-xs-4 date">
                            <i class="soap-icon-clock yellow-color"></i>
                            <div>
                                <span class="skin-color">End</span><br><?= $ads->endDateTime; ?>
                            </div>
                        </div>
                        <div class="col-xs-5 departure">
                            <i class="soap-icon-departure yellow-color"></i>
                            <div>
                                <span class="skin-color">Node</span><br>Los Angeles, miami, Florida
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="review pull-left">
                            <div class="five-stars-container">
                                <span class="five-stars" style="width: 60%;"></span>
                            </div>
                            <span>Ranking</span>
                        </div>
                        <a href="<?= Yii::$app->homeUrl . "user/promote-ads?adsId=" . $ads->adsId; ?>" class="button sea-blue btn-medium pull-right">PROMOTE ADS</a>
                        <a href="#manageAds<?= $ads->adsId; ?>" class="button dark-blue2 btn-medium pull-right soap-popupbox"><i class="soap-icon-list circle"></i> จัดการ</a>
                    </div>
                    <div id="manageAds<?= $ads->adsId ?>" class="travelo-login-box travelo-box">
                        <form>
                            <div class="form-group">
                                <img width="270" height="160" alt="" src="<?= \yii\helpers\Url::to(Yii::$app->homeUrl . $ads->image); ?>">
                            </div>
                            <div class="form-group ">
                                <a href="#conExpireDate<?= $asset->assetId ?>" class="button green btn-large full-width soap-popupbox"><i class="soap-icon-plus circle"></i> ต่ออายุประกาศ</a>
                            </div>
                            <div class="form-group ">
                                <a href="<?= \yii\helpers\Url::to(Yii::$app->homeUrl . "ads/update?id=" . $asset->assetId) ?>" class="button orange btn-large full-width"><i class="soap-icon-card circle"></i> แก้ไข</a>
                            </div>
                            <div class="form-group ">
                                <a href="<?= \yii\helpers\Url::to(Yii::$app->homeUrl . "ads/delete?id=" . $asset->assetId) ?>" class="button red btn-large full-width "><i class="soap-icon-close circle"></i> ลบ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
            <?php
            $i++;
        endforeach;
        ?>
    </div>
</div>
