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




$('#register_button').click(function validate(event) {
     // TODO all controls
    if(!document.getElementById("inputName").checkValidity())
        alert("Please insert a name");
    else if(!document.getElementById("inputSurname").checkValidity())
        alert("Please insert a surname");
    else if(!document.getElementById("inputEmail").checkValidity())
        alert("Please insert a valid email");
    else if(!document.getElementById("inputTel").checkValidity())
        alert("Please insert a phone number");
    else if(!document.getElementById("inputUsername").checkValidity())
        alert("Please insert a username");
    else if(!document.getElementById("inputPassword").checkValidity())
        alert("Please insert a password");
    else if(!document.getElementById("repeatPassword").checkValidity())
        alert("Please confirm your password");


    else if (!regEx.test(phoneField.value)) {
        alert("Please insert a valid telephone number");
    }

    else if (pwField.value != repeatField.value) {
        alert("You inserted two different passwords");
    }

    else if (usernameField.value.toUpperCase() == "admin".toUpperCase()) {
        alert("admin is not a valid username");
    }

    else if (usernameField.value.length >30) {
        alert("username is too long");
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


