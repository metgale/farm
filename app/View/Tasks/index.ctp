<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Tasks'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('title');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('completed');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('information');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('deadline');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($tasks as $task): ?>
			<tr>
				<td><?php echo h($task['Task']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($task['User']['name'], array('controller' => 'users', 'action' => 'view', $task['User']['id'])); ?>
				</td>
				<td><?php echo h($task['Task']['title']); ?>&nbsp;</td>
				<td><?php echo h($task['Task']['completed']); ?>&nbsp;</td>
				<td><?php echo h($task['Task']['information']); ?>&nbsp;</td>
				<td><?php echo h($task['Task']['deadline']); ?>&nbsp;</td>
				<td><?php echo h($task['Task']['created']); ?>&nbsp;</td>
				<td><?php echo h($task['Task']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $task['Task']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $task['Task']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $task['Task']['id']), null, __('Are you sure you want to delete # %s?', $task['Task']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Task')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>