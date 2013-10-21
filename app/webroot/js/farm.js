$(document).ready(function() {
	$('.task-metadata').on("click", function() {
		$('.task-information', this).slideToggle("slow");
	});
	$('.task-metadata').on("mouseover", function() {
		$('.task-title', this).addClass("hover");
	});
	$('.task-metadata').on("mouseleave", function() {
		$('.task-title', this).removeClass("hover");
	});
	
	
	$('.checkbox-submit').click(function(e) {
		var frm = $(this).closest('form');
		var task = $(this).closest('.task');
		$.ajax({
			type: frm.attr('method'),
			url: frm.attr('action'),
			data: frm.serialize(),
			success: function(data) {
				task.hide("slow");
			}
		});
	});
})
