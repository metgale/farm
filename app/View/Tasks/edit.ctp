<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Task', array('class' => 'form-horizontal')); ?>
		<fieldset>
			<legend><?php echo __('Edit %s', __('Task')); ?></legend>
			<?php
			echo $this->BootstrapForm->input('user_id', array(
				'required' => 'required',
				'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
			);
			echo $this->BootstrapForm->input('title', array(
				'required' => 'required',
				'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
			);
			echo $this->BootstrapForm->input('completed');
			echo $this->BootstrapForm->input('information', array(
				'required' => 'required',
				'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
			);
			echo $this->BootstrapForm->input('repeating', array(
				'required' => false)
			);
			echo $this->BootstrapForm->input('deadline', array(
				'class' => 'input-small',
				'required' => 'required',
				'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
			);
			echo $this->BootstrapForm->hidden('id');
			?>
			<div class = "form-actions">
				<button type = "submit" class = "btn btn-primary">Submit</button>
			</div>
		</fieldset>
		<?php echo $this->BootstrapForm->end(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
			<ul class="nav nav-list">
				<li class="nav-header"><?php echo __('Actions'); ?></li>
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Task.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Task.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Tasks')), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
				<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>
			</ul>
		</div>
	</div>
</div>