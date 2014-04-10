$(document).ready(function() {
	$('.task-metadata').on("click", function() {
		$('.task-information', this).slideToggle("slow");
	});



	$('.complete-task').click(function(e) {
		var frm = $(this).closest('form');
		var task = $(this).closest('.task');
		$.ajax({
			type: frm.attr('method'),
			url: frm.attr('action'),
			data: frm.serialize(),
			success: function(data) {
				if (data == 'Saved') {
					task.fadeOut("slow");
				} else {
					alert(data);
				}
			}
		});
	});
})
