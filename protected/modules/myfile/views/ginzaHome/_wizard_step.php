<div class="row form-group hidden">
	<div class="col-xs-12">
		<ul class="nav nav-pills nav-justified thumbnail setup-panel">
			<li class="<?php echo ($this->action->id == 'view' && ($model->status >= 3 )) ? 'active' : ''; ?>"><a href="#step-3">
					<h4 class="list-group-item-heading">Step 3</h4>
					<p class="list-group-item-text">เปรียบเทียบประเมินราคา</p>
				</a></li>

			<li class="<?php echo ($this->action->id == 'view' && $model->status == 2) ? 'active' : ''; ?>"><a href="#step-4">
					<h4 class="list-group-item-heading">Step 4</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
			<li><a href="#step-5">
					<h4 class="list-group-item-heading">Step 5</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
		</ul>
	</div>
</div>