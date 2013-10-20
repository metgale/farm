<?php foreach ($tasks as $task): ?>
	<article class="task">
		<span class="task-name"><?php echo $task['Task']['title']; ?></span>
		<span class="task-information"><?php echo $task['Task']['information']; ?></span>
	</article>
	<form class="task-complete" action="/farm/tasks/complete/<?php echo $task['Task']['id']; ?>" method="post">
		<input type="checkbox" class="checkbox-submit">
	</form>
<?php endforeach; ?>