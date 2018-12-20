
function fetch(){

	$.ajax({
				url: '/eboard/eboard/server/queries/adnavigation.php',
				type: 'GET',
				success: function(data, status){
					var res = jQuery.parseJSON(data);
					var content = JSON.stringify(res);
					console.log("Fetched: " + content);
				}

		});
}