
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
function setup(id){
	console.log("Setting up player2...");

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
}


function addClickListeners(){

	

}
