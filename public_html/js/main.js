$("document").ready(function(){
	$(".folder").click(function(){
		t=encodeURI($(this).children(".title").children('a').attr('href'));
		$("body").load(t);
	})
});