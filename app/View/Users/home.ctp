<div class="home">
	<div class="user-nav">
		<li><a href="/tasks/add" class="big">Add new task</a> or	<a href="/tasks/index">Manage tasks</a>
			<br><br>
		<li><a href="/users/add" class="big">Add new volunteer</a> or <a href="/users/index">Manage volunteers</a></li>
	</div>
	<div class="latestTasks">
		<h4>Upcoming tasks:</h4>
		<?php if ($tasks): ?>
			<ul>
				<table>
					<?php foreach ($tasks as $task): ?>
					<br><br><tr><?php echo $task['Task']['title']; ?><b>, at </b><?php echo $task['Task']['deadline']; ?><b>, assigned to: </b><?php echo $task['User']['username']; ?></tr>
					<?php endforeach; ?>
				</table>
			<?php else: ?>
				<small>There are currently no upcoming tasks</small>
			<?php endif; ?>
		</ul>
		<li><h3><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></h3></li>

	</div>
</div>