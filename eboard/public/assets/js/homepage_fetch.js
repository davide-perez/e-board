
//Fetches content for the coverflow
// look https://stackoverflow.com/questions/40354638/ajax-to-get-image-from-remote-server for get images from link
/*function fetch(){

	$.ajax({
				url: '/eboard/eboard/server/queries/homepage.php',
				type: 'GET',
				success: function(data, status){
					var res = jQuery.parseJSON(data);
					var playlist = JSON.stringify(res);
					console.log("Playlist: " + playlist);
					setup("player", playlist);
				}

		});
}
*/


/**
* Sets up the coverflow component.
*/


var coverData = {

	ids: [],
	titles: [],
	description: [],

	addId: function(id){this.ids.push(id)},
	addTitle: function(title){this.titles.push(title)},
	addDesc: function(desc){this.description.push(desc)},

	getId: function(index){return this.ids[index]},
	getTitle: function(index){return this.title[index]},
	getDesc: function(index){return this.description[index]}

}


function setup(id){

	coverflow(id).setup({

        flash: "/eboard/eboard/public/assets/js/lib/coverflow/coverflow.swf",
        playlist: "/eboard/eboard/server/queries/homepage.php",
        width: '100%',
        height: 600,
        y: -20,
        backgroundcolor: "ffffff",
        coverwidth: 460,
        coverheight: 400,
        fixedsize: true,
        textoffset: 50,
        textstyle: ".coverflow-text{color:#000000;text-align:center;font-family:Arial Rounded MT Bold,Arial;} .coverflow-text h1{font-size:14px;font-family:inherit;font-weight:normal;line-height:21px;} .coverflow-text h2{font-size:12px;font-family:inherit;font-weight:normal;} .coverflow-text a{color:#0000EE;}"

    });

	loadLocalData();

    coverflow(id).on("click", 
    				function(index){
    					let id = coverData.getId(index);
    					showDetails(id);
    					
    				});


}



function showDetails(id){
	//divertiti
	$.ajax({
				url: '/eboard/eboard/server/queries/homepage_modal.php',
				type: 'POST',
				data:{
					'ad_id': id 
				},
				success: function(data, status){
					var res = jQuery.parseJSON(data);

					for(let entry of res){
						fillModal(entry.title, entry.description, entry.image, entry.date, entry.username, entry.mail, entry.phone, entry.gallery, entry.hasGallery );
						

					}
				}

		});
}

function fillModal (title, description, link, date_pub, username, mail, phone, images, hasGallery) {
    
    $('#adTitle').html('<span class="glyphicon glyphicon-pushpin"></span> ' + title);


    $('#modalImage').css('background-image', 'url("' + link + '")');
    $('#adDescription').html(description.replace(/\\'/g, "'"));
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

function loadLocalData(){

	$.ajax({
				url: '/eboard/eboard/server/queries/homepage.php',
				type: 'GET',
				success: function(data, status){
					var res = jQuery.parseJSON(data);

					for(let entry of res){

						coverData.addId(entry.id);
						coverData.addTitle(entry.title);
						coverData.addDesc(entry.description);

					}
				}

		});

}

