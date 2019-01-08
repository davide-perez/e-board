
  function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' multiple>");
        console.log("Created element: \n");
        console.log(element)
        element.attr("id", "imgblob");
        element.attr("name", "images");
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
}

$(function() {
  bs_input_file();
});


function uploadFile() {

    var images = $(".input-ghost");
    console.log("values");
    console.table(images);
    console.log("There are " + images.length + " files about to be sent.");
    var form = new FormData();
    let count = 0;
    for(let img of images){
      form.append("image" + count, images);
      count = count + 1;
    }

    $.ajax({
       url: "/eboard/eboard/server/php/ad_insertion.php",
       type: "POST",
       data: form,
       processData: false,
       contentType: false,
       success: function(response) {
           //alert("Data sent succesfully!");
           alert(response);
       },
       error: function(jqXHR, textStatus, errorMessage) {
           console.log(errorMessage); // Optional
       }
    });
}
  