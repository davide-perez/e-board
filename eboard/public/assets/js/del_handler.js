/**
* Handles the deletion of an ad.
*/
function del(id){
	if(confirm("Are you sure you want to delete this ad?")){
		deleteFromDB(id);
	}
	else{

	}
}

/**
* Performs AJAX call to the server sending id of ad to delete. Reloads the page when the action has been executed.
*/
function deleteFromDB(id){

	$.ajax({
  		type: "POST",
  		url: "/eboard/eboard/server/php/ad_deletion.php",
  		data: { ad_id: ""  + id}
	}).done(function(msg) {
  		alert(msg);
  		document.location.reload();
	});    

}