
var username = document.getElementById("inputUsername");
var password = document.getElementById("inputPassword");

$('#login_button').click(function validate(event) {
     // TODO all controls
    if(!username.checkValidity())
        alert("Please insert a username");

    else if(!password.checkValidity())
        alert("Please insert a password");

    
    

    else {

        var $form = $('#Login');
        var $inputs = $form.find("input");
        var serializedData = $form.serialize();

        request = $.ajax({
            url: "/eboard/eboard/server/php/user_login.php",
            type: "post",
            data: serializedData
        });


        request.done(function(response, textStatus, jqXHR){
            console.log(response);
            if (response == "mistake") {
                
                alert("No user found with the inserted credentials");
                
            }
            else {
                $form.submit();
            }
        });
    }
    

    



});


