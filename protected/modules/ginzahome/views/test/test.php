<!DOCTYPE html>


<div class="container">
    <!-- Filter Controls - Simple Mode -->
    <div class="row">
        <!-- A basic setup of simple mode filter controls, all you have to do is use data-filter="all"
        for an unfiltered gallery and then the values of your categories to filter between them -->
        <ul class="simplefilter">
            Simple filter controls:
            <li class="active" data-filter="all">All</li>
            <li data-filter="1">Cityscape</li>
            <li data-filter="2">Landscape</li>
            <li data-filter="3">Industrial</li>
            <li data-filter="4">Daylight</li>
            <li data-filter="5">Nightscape</li>
        </ul>
    </div>

    <div class="row">
        <!-- This is the set up of a basic gallery, your items must have the categories they belong to in a data-category
        attribute, which starts from the value 1 and goes up from there -->
        <div class="filtr-container">
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="1, 5" data-sort="Busy streets">
                <img class="img-responsive" src="img/city_1.jpg" alt="sample image">
                <span class="item-desc">Busy Streets</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="2, 5" data-sort="Luminous night">
                <img class="img-responsive" src="img/nature_2.jpg" alt="sample image">
                <span class="item-desc">Luminous night</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="1, 4" data-sort="City wonders">
                <img class="img-responsive" src="img/city_3.jpg" alt="sample image">
                <span class="item-desc">city wonders</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="3" data-sort="In production">
                <img class="img-responsive" src="img/industrial_1.jpg" alt="sample image">
                <span class="item-desc">in production</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="3, 4" data-sort="Industrial site">
                <img class="img-responsive" src="img/industrial_2.jpg" alt="sample image">
                <span class="item-desc">industrial site</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="2, 4" data-sort="Peaceful lake">
                <img class="img-responsive" src="img/nature_1.jpg" alt="sample image">
                <span class="item-desc">peaceful lake</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="1, 5" data-sort="City lights">
                <img class="img-responsive" src="img/city_2.jpg" alt="sample image">
                <span class="item-desc">city lights</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="2, 4" data-sort="Dreamhouse">
                <img class="img-responsive" src="img/nature_3.jpg" alt="sample image">
                <span class="item-desc">dreamhouse</span>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 filtr-item" data-category="3" data-sort="Restless machines">
                <img class="img-responsive" src="img/industrial_3.jpg" alt="sample image">
                <span class="item-desc">restless machines</span>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery & Filterizr -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        //Initialize filterizr with default options
        $('.filtr-container').filterizr();
    });</script>
<div class="controls">
    <label>Filter:</label>

    <button class="filter" data-filter="all">All</button>
    <button class="filter" data-filter=".category-1">Category 1</button>
    <button class="filter" data-filter=".category-2">Category 2</button>

</div>
<div id="Container" class="container1">
    <div class="mix category-1" >1</div>
    <div class="mix category-1" >2</div>
    <div class="mix category-1" >3</div>
    <div class="mix category-2" >4</div>
    <div class="mix category-1" >5</div>
    <div class="mix category-1" >6</div>
    <div class="mix category-2" >7</div>
    <div class="mix category-2" >8</div>

</div>
<script>
    $(function () {
        $('#Container').mixItUp();
    });
</script>
