//Fields to check
var regEx = new RegExp('^[0-9]+$');
var pwField = document.getElementById("inputPassword");
var repeatField = document.getElementById("repeatPassword");
var phoneField = document.getElementById("inputTel");
var usernameField = document.getElementById("inputUsername");


//Function that checks that the two password are the same
function checkPassword() {
    
    if (repeatField.value != "") {
    	if(pwField.value != repeatField.value) {
        	repeatField.style.backgroundColor = "red";
    	} else {
        	repeatField.style.backgroundColor = "lightgreen";
    	}
	}
	else 
		repeatField.style.backgroundColor = "";
}

repeatField.addEventListener("keyup", checkPassword);
pwField.addEventListener("keyup", checkPassword);


// function that controls the phone number

function checkTelephone() {

    
    
    if (phoneField.value != ""){
        if(!regEx.test(phoneField.value)) {
            phoneField.style.backgroundColor = "red";
        } else {
            phoneField.style.backgroundColor = "";
        }
    }
    else 
        phoneField.style.backgroundColor = "";
}

if (phoneField != null)
    phoneField.addEventListener("keyup", checkTelephone);


// function that checks some inputs

function validate() {
    // control the telephone number
    if (!regEx.test(phoneField.value)) {
        alert("Please insert a valid telephone number");
        return false;
    }

    if (pwField.value != repeatField.value) {
        alert("You inserted two different passwords");
        return false;
    }

    if (usernameField.value.toUpperCase() == "admin".toUpperCase()) {
        alert("admin is not a valid username");
        return false;
    }


    return true;
}



$('#register_button').click(function validate(event) {
     // control the telephone number
    if (!regEx.test(phoneField.value)) {
        alert("Please insert a valid telephone number");
    }

    else if (pwField.value != repeatField.value) {
        alert("You inserted two different passwords");
    }

    else if (usernameField.value.toUpperCase() == "admin".toUpperCase()) {
        alert("admin is not a valid username");
    }
    

    else {

        var $form = $('#Registration');
        var $inputs = $form.find("input");
        var serializedData = $form.serialize();

        request = $.ajax({
            url: "/eboard/eboard/server/php/user_registration.php",
            type: "post",
            data: serializedData
        });


        request.done(function(response, textStatus, jqXHR){
            console.log(response);
            if (response == "mistake") {
                
                alert("Username or mail already in use.");
                
            }
            else {
                $form.submit();
            }
        });
    }

    



});


$('#inputEMail').blur(function(event) {
    event.target.checkValidity();
}).on('invalid', function(event) {
    setTimeout(function() { $(event.target).focus();}, 50);
});
