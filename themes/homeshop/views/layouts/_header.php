<!-- Header -->
<header class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<!-- Top Header -->
<?php $this->renderPartial('//layouts/_top_header');?>
<!-- /Top Header -->

<!-- Main Header -->
<?php $this->renderPartial('//layouts/_main_header');?>
<!-- /Main Header -->

<!-- Main Navigation -->
<?php if($this->id !== 'home') $this->renderPartial('//layouts/_main_navigation');?>
<!-- /Main Navigation -->

</div>

</header>
<!-- /Header -->