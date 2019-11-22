$(document).ready(function() {
	//parallax
	$(window).on("load", function() {
		$(".parallax1").addClass("show");
		$(".parallax2").addClass("show");
	});

	$(window).scroll(function() {
		var scrolling = $(this).scrollTop();

		if (scrolling > $("#content").offset().top - 550) {
			$("#content .box").each(function(i) {
				setTimeout(function() {
					$("#content .box")
						.eq(i)
						.addClass("show");
				}, 100 * i);
			});
		}
	});
});
