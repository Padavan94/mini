
//counter

$(document).on('ready', function(event) {
	/*$(".counter").find("input").val("1");*/
	
	
	$(document).on('click', '.increment', function(event) {
		event.preventDefault();
		var num = +$(this).parent().parent().find("input").val();
		console.log(typeof +num);
		$(this).parent().parent().find("input").val(++num);
	});

	$(document).on('click', '.decrement', function(event) {
		event.preventDefault();
		if(+$(this).parent().parent().find("input").val() > 1) {
			var num = +$(this).parent().parent().find("input").val();
			$(this).parent().parent().find("input").val(num-1);
		}
	});

	$(".mobile_menu_trigger").click(function(event) {
		$("#menu ul").slideToggle("slow");
	});
});

