function update_url(url,name){
	if(typeof history.pushState == 'function') { 
		var stateObj = { foo: "bar" };
		history.pushState(stateObj, "PhotoLight - " + name, url);
	}
}

$("document").ready(function(){
	$(".folder").click(function(){
		$("#loading").show();
		t=encodeURI($(this).children(".title").children('a').attr('href'));
		n=$(this).children(".title").children('a').html();
		$("body").load(t);
		update_url(t,n);
	});
	
	$(".thumb").click(function(){
		t=encodeURI($(this).children('a').attr('href'));
		$("#imgviewer").html('<img src="'+t+'">');
		$("#viewer").fadeIn();			
		return false;
	});
	
	$("#container").click(function(){
		$("#viewer").fadeOut();
	});

	
});