<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="tabs">
            <div class="tab-heading">
                <?php
                $i = 1;
                foreach($tabs as $tab)
                {
                    $title = $tab['title'];
                    $tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;

                    echo CHtml::link($tab['title'] . ' ', '#' . $tabId, array(
                        'class'=>'button big'));
                    $i++;
                }
                ?>
            </div>

            <div class="page-content tab-content">
                <?php
                $i = 1;
                foreach($tabs as $tab)
                {
                    $title = $tab['title'];
                    //$tabHeading .= "<a href=\"#tab$i\" class=\"button big\">$title</a> ";
                    $tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;
                    ?>
                    <div id="<?php echo $tabId ?>">
                        <?php
                        echo $tab['detail'];
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>