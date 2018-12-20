
function fetch(){

	$.ajax({
				url: '/eboard/eboard/server/queries/adnavigation.php',
				type: 'GET',
				success: function(data, status){
					var res = jQuery.parseJSON(data);
					//var content = JSON.stringify(res);
					console.log("Fetched: " + res);
					format(res);
				}

		});
}



function setCategory(category) {
	$(".cat-title").text(category);
	$(".cat-text").text("Private lectures offerings and requests");
}


function format(content){

	var category = content[0].category;
	var ads = content[1].ads;
	setCategory(category);

}
