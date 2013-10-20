$(document).ready(function() {
	$('.task').on("click", function() {
		$('.task-information', this).slideToggle();
	});
	
	$('.checkbox-submit').click(function(e) {
		var frm = $(this).closest('form');
		$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function(data) {
					alert('ok');
				}
			});

//		frm.submit(function(ev) {
//			$.ajax({
//				type: frm.attr('method'),
//				url: frm.attr('action'),
//				data: frm.serialize(),
//				success: function(data) {
//					alert('ok');
//				}
//			});
//
//			ev.preventDefault();
//		});
	});

	

})
