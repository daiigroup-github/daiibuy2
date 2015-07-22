<div class="row form-group hidden">
	<div class="col-xs-12">
		<ul class="nav nav-pills nav-justified thumbnail setup-panel">
			<li class="<?php echo ($this->action->id == 'view' && ($model->status >= 3 )) ? 'active' : ''; ?>"><a href="#step-3">
					<h4 class="list-group-item-heading">Step 3</h4>
					<p class="list-group-item-text">เปรียบเทียบประเมินราคา</p>
				</a></li>

			<li class=""><a href="#step-3-1">
					<h4 class="list-group-item-heading">Step 3-1</h4>
					<p class="list-group-item-text">ชำระสัญญา</p>
				</a></li>
			<li class=""><a href="#step-3-2">
					<h4 class="list-group-item-heading">Step 3-2</h4>
					<p class="list-group-item-text">แบ่งชำระ</p>
				</a></li>

			<li class="<?php echo ($this->action->id == 'view' && $model->status == 2) ? 'active' : ''; ?>"><a href="#step-4">
					<h4 class="list-group-item-heading">Step 4</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
			<li class="<?php echo ($model->isNewRecord) ? "active" : ""; ?>"><a href="#step-c1" >
					<h4 class="list-group-item-heading">Step 1 Create</h4>
					<p class="list-group-item-text">Create Ginza Town Myfile</p>
				</a></li>
			<li><a href="#step-c2">
					<h4 class="list-group-item-heading">Step 2 Create</h4>
					<p class="list-group-item-text">Confirm Create Ginza Town Myfile</p>
				</a></li>
			<li class="<?php echo (isset($model) && $model->type > 1) ? "active" : ""; ?>"><a href="#step-c3">
					<h4 class="list-group-item-heading">Step 3 Create</h4>
					<p class="list-group-item-text">Complete Create Ginza Town Myfile</p>
				</a></li>
		</ul>
	</div>
</div>