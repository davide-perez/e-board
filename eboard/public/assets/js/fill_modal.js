
function fillModal (title, description, link, date_pub, username, mail, phone, images, hasGallery) {
    
    $('#adTitle').html('<span class="glyphicon glyphicon-pushpin"></span> ' + title);

    $('#modalImage').css('background-image', 'url("' + link + '")');
    $('#adDescription').html(description);
    $('#contactsPanel').html('<p class = "lead"><span class="glyphicon glyphicon-user"></span> Published by <b>' + username + '</b> on date ' + date_pub + '</p> <p class = "lead"><span class="glyphicon glyphicon-envelope"></span> ' + mail + '</p> <p class = "lead"><span class="glyphicon glyphicon-phone"></span> ' + phone + '</p>');
    $('#photoGallery').remove();
    $('#hrGallery').remove();
    $('#myCarousel').remove();


    if (hasGallery == "true" && $('#modalContainer').find($('#myCarousel')).length == 0) {

    	$('#modalContainer').append('<h3 id = "photoGallery">Photo Gallery</h3><hr id = "hrGallery">');
    	$('#modalContainer').append('<div id="myCarousel" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators" id = "carousel-indicators"></ol><div class="carousel-inner" id = "carousel-inner"></div><a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span></a></div>');

    	var single_image = images.split(" ");
    	for (x = 0; x < single_image.length; x++) {
    		if (x == 0) {
    			$('#carousel-indicators').append('<li data-target="#myCarousel" data-slide-to="0" class="active"></li>'); 
    			$('#carousel-inner').append('<div class="item active"><img src="'+single_image[x]+'" ></div>')
    		}
    		
    		else {
    			$('#carousel-indicators').append('<li data-target="#myCarousel" data-slide-to="' + x + '"></li>'); 
    			$('#carousel-inner').append('<div class="item"><img src="'+single_image[x]+'" ></div>')

    		}
    	}
    }

    $('#adModal').modal('show');

    
  }


function fillModalMod (title, description, link, username, adclass) {
    
    $('#adTitle').html('<span class="glyphicon glyphicon-pushpin"></span> ' + title);

    $('#modalImage').css('background-image', 'url("' + link + '")');
    $('#adDescription').html(description);
    $('#contactsPanel').html('<p class = "lead"><span class="glyphicon glyphicon-user"></span> Published by <b>' + username + '</b></p>');

    setActions(adclass);

    $('#adModal').modal('show');
    
  }