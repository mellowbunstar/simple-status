$(document).ready(function() {

	//$(".alert").alert();
	
	$("#body").keyup(function() {
		var i = 140 - $(this).val().length;
		$(".counter").text(i);
		if (i < 25) {
			$(".counter").addClass('limit');
		} else {
			$(".counter").removeClass('limit');
		}
		  
	});
	
	function doMsg(text, type) {
		$("#form-posts").prepend('<p class="alert alert-' + type + '" fade in><button type="button" class="close" data-dismiss="alert">&times;</button>' + text + '</div>');
		$(".spin").spin(false);
	}
	
	$("#form-posts form").submit(function(e) {
		e.preventDefault();

 		$(".spin").spin('small');
		$(".alert").remove();
		
		if ($("#body").val() == '') {
            doMsg('Post cannot be empty.', 'error');
        }
		else if ($("#body").val().length > 140) {
			doMsg('Post can only be 140 characters max.', 'error');
		}
		else {
			$.ajax({
				type: "POST",
				url: "libs/process.php",
				data: ({
					body: $("#body").val(),
					ajx: true
				}),
				error: function(msg) {
					doMsg(msg, 'error');
				},
				success: function(msg) {
					$("#posts").prepend(msg);
					$("#body").val('');
					$(".spin").spin(false);
					$(".counter").text('140');
				}
			});
		}
	});
	
});