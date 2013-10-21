<div class="row">
	<h4 class="pagetitle">Task assignments for <?= $user['User']['username']; ?><small> notifications to: <?= $user['User']['email']?></small></h4>
	<?php foreach ($tasks as $task): ?>
		<div class="span12 task">
			<div class="task-metadata">
				<div class="task-title"><?php echo $task['Task']['title']; ?> <small class="tiny"><?php if ($task['Task']['repeating'] == 1): ?>(daily task)<?php else: ?>(single task)<?php endif; ?></small></div>
				<div class="task-information"><?php echo $task['Task']['information']; ?></div>
			</div>
			<form class="task-complete" action="/farm/tasks/complete/<?php echo $task['Task']['id']; ?>" method="post">
			</form>
			<button class="checkbox-submit btn btn-success btn-small pull-right">Complete</button>
			<div class="task-deadline">Deadline: <?php echo $this->Time->niceshort($task['Task']['deadline']); ?>, </div>		
		</div>
	<?php endforeach; ?>
</div>	