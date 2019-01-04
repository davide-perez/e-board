//Fields to check
var pwField = document.getElementById("inputPassword");
var repeatField = document.getElementById("repeatPassword");
var phoneField = document.getElementById("inputTel");


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

    var regEx = new RegExp('^[0-9]+$');
    
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