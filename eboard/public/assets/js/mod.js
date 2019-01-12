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
  console.log("AD's id: " + id);

    switch(adclass){

      case "approved":

        appendButton("revoke-btn", "Revoke", revoke);

      break;
      case "pending":



      break;
      case "outdated":


      break;
      case "rejected": 


      break;

    }


}


function appendButton(id, caption, evt){

  $('<input type="button" id="' + id + '" value="' + caption + '">').appendTo("#contactsPanel");
  $("#" + id).click(evt);

}


function revoke(id){

  if(confirm('Are you sure you want to revoke this ad? It will be marked as "pending" and will no more be visible until it is approved again.')){
    alert("Ad revoked");
    //do ajax stuff + redirect on the pending page
    //mail service please: https://stackoverflow.com/questions/15965376/how-to-configure-xampp-to-send-mail-from-localhost
  }
  else{

  }

}






function getID(adclass){

  var id = $("#" + adclass + "-ads").find("tbody tr:first").children(":first").text();
    return id;

}