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

