<div class="home">
	<div class="user-nav">
		<a href="/farm/tasks/add" class="big">Add new task</a> or	<a href="/farm/tasks/index">Manage tasks</a>
		<br><br>
		<a href="/farm/users/add" class="big">Add new volunteer</a> or <a href="/farm/users/index">Manage volunteers</a>
	</div>
	<div class="latestTasks">
		<h4>Upcoming tasks:</h4>
		<?php if ($tasks): ?>
			<ul>
				<?php foreach ($tasks as $task): ?>
				<br><li><?php echo $task['Task']['title']; ?><b>, at </b><?php echo $task['Task']['deadline']; ?><b>, assigned to: </b><?php echo $task['User']['username']; ?></li>
				<?php endforeach; ?>

			<?php else: ?>
				<small>There are currently no upcoming tasks</small>
			<?php endif; ?>
		</ul>
		<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>

	</div>
</div>