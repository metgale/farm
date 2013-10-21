<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Task', array('class' => 'form-horizontal')); ?>
		<fieldset>
			<legend><?php echo __('Create new task'); ?></legend>
			<?php
			echo $this->BootstrapForm->input('user_id', array(
				'label' => 'Assign to',
				'required' => 'required',
					)
			);
			echo $this->BootstrapForm->input('title', array(
				'label' => 'Task name',
				'required' => 'required',
					)
			);
			echo $this->BootstrapForm->input('information', array(
				'label' => 'Additional information',
				'required' => 'required',
					)
			);
			echo $this->BootstrapForm->input('repeating', array(
				'label' => 'Daily',
				'required' => false)
			);
			echo $this->BootstrapForm->input('deadline', array(
				'required' => 'required',
				'class' => 'input-small'
					)
			);
			?>
			<div class = "form-actions">
				<button type = "submit" class = "btn btn-primary">Create new task</button>
			</div>
		</fieldset>
		<?php echo $this->BootstrapForm->end(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
			<ul class="nav nav-list">
				<li class="nav-header"><?php echo __('Actions'); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Tasks')), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
				<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>
			</ul>
		</div>
	</div>
</div>