$(document).ready(function() {

	$(".alert").alert();
	
	$("#body").keyup(function () {
		var i = 140 - $(this).val().length;
		$(".counter").text(i);
		if (i < 25) {
			 $(".counter").addClass('limit');
		} else {
			$(".counter").removeClass('limit');
		}
		  
	});
	
});