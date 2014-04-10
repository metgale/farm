<div class="row">
	<h4 class="pagetitle">Task assignments for <?= $user['User']['username']; ?><small> notifications to: <?= $user['User']['email'] ?></small></h4>
</div>


<?php foreach ($tasks as $task): ?>

	<div class="row task">
		<div class="span6 task-metadata">
			<a href="#" class="task-title">
				<?php echo $task['Task']['title']; ?> 
			</a>
			<div class="task-information">
				<?php echo $task['Task']['information']; ?>
				<small class="tiny"><?php if ($task['Task']['repeating'] == 1): ?>(daily task)<?php else: ?>(one time task)<?php endif; ?></small>
			</div>
			<div class="task-deadline">Deadline: <?php echo $this->Time->niceshort($task['Task']['deadline']); ?></div>		
		</div>

		<div class="span6 task-metadata">
			<form class="form-complete" action="/tasks/complete/<?php echo $task['Task']['id']; ?>" method="post">
				<a class="complete-task btn btn-success btn-small">Complete</a>
			</form>
		</div>
	</div>
<?php endforeach; ?>
