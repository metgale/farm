<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('Task'); ?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($task['Task']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($task['User']['username'], array('controller' => 'users', 'action' => 'view', $task['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($task['Task']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Completed'); ?></dt>
			<dd>
				<?php echo h($task['Task']['completed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Information'); ?></dt>
			<dd>
				<?php echo h($task['Task']['information']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deadline'); ?></dt>
			<dd>
				<?php echo h($task['Task']['deadline']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($task['Task']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($task['Task']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
			<ul class="nav nav-list">
				<li class="nav-header"><?php echo __('Actions'); ?></li>
				<li><?php echo $this->Html->link(__('Edit %s', __('Task')), array('action' => 'edit', $task['Task']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete %s', __('Task')), array('action' => 'delete', $task['Task']['id']), null, __('Are you sure you want to delete # %s?', $task['Task']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List %s', __('Tasks')), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New %s', __('Task')), array('action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>
			</ul>
		</div>
	</div>
</div>

