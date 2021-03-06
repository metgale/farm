<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('User', array('class' => 'form-horizontal')); ?>
		<fieldset>
			<legend><?php echo __('Add %s', __('User')); ?></legend>
			<?php
			echo $this->BootstrapForm->input('username', array('required' => 'required'));
			echo $this->BootstrapForm->input('email', array('required' => 'required'));
			echo $this->BootstrapForm->input('password', array('required' => 'required'));
			echo $this->BootstrapForm->input('admin', array('required' => false));
			?>
			<div class = "form-actions">
				<button type = "submit" class = "btn btn-primary">Add new user</button>
			</div>
		</fieldset>
		<?php echo $this->BootstrapForm->end(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
			<ul class="nav nav-list">
				<li class="nav-header"><?php echo __('Actions'); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Users')), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Tasks')), array('controller' => 'tasks', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('New %s', __('Task')), array('controller' => 'tasks', 'action' => 'add')); ?></li>
				<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>

			</ul>
		</div>
	</div>
</div>