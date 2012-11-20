$("document").ready(function(){
	$(".folder").click(function(){
		$("body").load($(this).children(".title").children('a').attr('href'));
	})
});