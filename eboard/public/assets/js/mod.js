/**
  Called when the document root has been completely loaded. Sets the tab counter
  by reading the number of rows of each table, instead of repeating the query to
  get the length of the result set, which may be time-consuming when having many records.
  */
  function setTabsCounter(){
    $("#approved-count").text($("#approved-ads").find("tbody > tr").length);
    $("#pending-count").text($("#pending-ads").find("tbody > tr").length);
    $("#outdated-count").text($("#outdated-ads").find("tbody > tr").length);
    $("#rejected-count").text($("#rejected-ads").find("tbody > tr").length);
  }


  function setActions(adclass){

  var id = getID(adclass);

    switch(adclass){

      case "approved":

        appendButton("revoke-btn-1", "revoke-btn btn-warning", "Revoke", () => {revoke(id)});

      break;
      case "pending":

        appendButton("accept-btn-2", "accept-btn btn-success", "Accept", () => {approve(id)});
        appendButton("reject-btn-2", "reject-btn btn-warning", "Reject", () => {reject(id)});


      break;
      case "outdated":

        appendButton("restore-btn-4", "restore-btn btn-info", "Restore", () => {restore(id)});
        appendButton("delete-btn-4", "delete-btn btn-danger", "Delete", () => {del(id)});


      break;
      case "rejected": 

        appendButton("restore-btn-3", "restore-btn btn-info", "Restore", () => {restore(id)});
        appendButton("delete-btn-3", "delete-btn btn-danger", "Delete", () => {del(id)});


      break;


    }


}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
* The following functions take as argument the id of an ad, then send it to the server along with a string representing the
* command to execute on such ad. The possible actions are:
*
* -Approve: approve the ad, making it visible on the website. Only ads that are pending can be approved
* -Revoke: move an active ad back to pending, thus making it no more visible on the site
* -Reject: reject a pending ad, moving it in the rejected queue. There the ads can either be deleted permanently,
*          or restored. However, they are periodically deleted from the database.
* -Restore: an ad that is either outdated or rejected can be moved back in the pending queue via "restore" operation.
* -Delete: implemented in function del. The passed ad is deleted permanently from the database and the site.
* -Delete all: implemented in delete_all. Empties the rejected/outdated query, deleting permanently all the ads in it.
*
*
*/

function revoke(id){

  if(confirm("Are you sure you want to revoke this ad? It will be moved back in the pending queue and will be no more visible on the site until it will be approved again.")){
    requestForAction(id, "revoke");
  }
  else{}

}

function approve(id){

  requestForAction(id, "approve");

}


function reject(id){
  //create service to delete ad that are rejected from some time
  if(confirm("Are you sure you want to reject this ad? It will be moved in the rejected queue.")){
    requestForAction(id, "reject");
  }
  else{}

}


function restore(id){
  //create service to delete ad that are rejected from some time
  if(confirm("Are you sure you want to restore this ad? It will be moved in the pending queue.")){
    requestForAction(id, "restore");
  }
  else{}

}


function del(id){
  //create service to delete ad that are rejected from some time
  if(confirm("Are you sure you want to delete this ad? It will be removed permanently from the website!")){
    requestForAction(id, "delete");
  }
  else{}

}


function delete_all(id){
  //create service to delete ad that are rejected from some time
  if(confirm("Are you sure you want to delete all the ads in the queue? They will be removed permanently from the website!")){
    requestForAction(id, "delete_all");
  }
  else{}

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
* This utility function is used to implement a request to the server for an operation on a specific ad.
* Takes as params the id of the ad and a string representing an action (see the above commands and management_service.php).
* Requests are implemented as AJAX post calls.
*/
function requestForAction(id, action){

  var ad_id = id + "";
  //do ajax stuff + redirect on the pending page
  //mail service please: https://stackoverflow.com/questions/15965376/how-to-configure-xampp-to-send-mail-from-localhost
  $.post('/eboard/eboard/server/php/management_service.php', {idVal: ad_id, command: action})
  .done(function(msg){ alert("Done: " + msg); document.location.reload();})
  .fail(function(xhr, status, error) { alert("Request on" + ad_id + " failed with status " + status + ". Reason: " + error); });


}


/**
* Retrieves the id of an ad, given one of the four classnames ("approved, rejected, outdated, pending")
*
*/
function getID(adclass){

  var id = $("#" + adclass + "-ads").find("tbody tr:first").children(":first").text();
    return id;

}


/**
* Shorthand function to create a button and append it to the
* Params:
* -a unique id
* -button's class name
* -button's text
* -function to perform on click
*/
function appendButton(id, clazz, caption, evt){

  $('<input type="button" id="' + id + '" class ="' + clazz + '" value="' + caption + '">').appendTo("#contactsPanel");
  $("#" + id).click(evt);

}