/**
* Makes an AJAX call to the server, fetching the ads corresponding to the user
*/
function fetch(){

	$.ajax({
				url: '/eboard/eboard/server/queries/user.php',
				type: 'GET',
				success: function(data, status){
					var res = jQuery.parseJSON(data);
					populateAdPage(res);
				}

		});

}



/**
* Iterativelly builds all the ads fetched.
*/
function setAds(ads){

	ads.forEach(buildAd);

}

/**
* Given a single ad as a JavaScript object, creates a single "card" for representing it along with its parameters (title, content, image)
*/
function buildAd(ad){


	var $adlist = $("#personal_ads");
	var $adcontainer = $("<div class=\"col-lg-3 col-md-4 col-sm-6 portfolio-item\">")

	$adlist.append($adcontainer);

	var $body = $("<div class=\"card-body\">");

	var $img = $("<div id=\"card-image\">");
	$img.css("background-image", "url(" + ad.image + ")");

	$body.append($img);

	var $title = $("<h4 class=\"card-title\">");
	var $titlelink = $("<a href=\"#\">" + ad.title + "</a>");

	$title.append($titlelink);
	$body.append($title);

	var $text = $("<p class=\"card-text\">" + ad.description + "</p>");
	$body.append($text);

	$adcontainer.append($body);

}

/**
* Fills the page with a representation for every ad.
*/
function populateAdPage(content){

	var ads = content[0].ads;
	setAds(ads);

}
