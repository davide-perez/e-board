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

        appendButton("approved-btn", "Revoke", () => {revoke(id)});

      break;
      case "pending":

        appendButton("pending-btn", "Accept", () => {approve(id)});


      break;
      case "outdated":

        appendButton("outdated-btn", "Restore", () => {approve(id)});


      break;
      case "rejected": 

        appendButton("revoke-btn", "Restore", () => {accept(id)});
        appendButton("revoke-btn", "Delete", () => {revoke(id)});



      break;

    }


}


function appendButton(id, caption, evt){

  $('<input type="button" id="' + id + '" value="' + caption + '">').appendTo("#contactsPanel");
  $("#" + id).click(evt);

}


function revoke(id){

  if(confirm("Are you sure you want to revoke this ad? It will be moved back in the pending queue and will be no more visible on the site until it will be approved again.")){
    requestForAction(id, "revoke");
  }
  else{

  }

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


function requestForAction(id, action){

  var ad_id = id + "";
  //do ajax stuff + redirect on the pending page
  //mail service please: https://stackoverflow.com/questions/15965376/how-to-configure-xampp-to-send-mail-from-localhost
  $.post('/eboard/eboard/server/php/management_service.php', {idVal: ad_id, command: action})
  .done(function(msg){ alert("Done: " + msg); document.location.reload();})
  .fail(function(xhr, status, error) { alert("Request on" + ad_id + " failed with status " + status + ". Reason: " + error); });


}



function getID(adclass){

  var id = $("#" + adclass + "-ads").find("tbody tr:first").children(":first").text();
    return id;

}