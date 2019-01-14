// fields to check
var descriptionField = document.getElementById("description");
var titleField = document.getElementById("title");
var lengthNum = document.getElementById("character_num");

//Function that checks the length of the description
function checkLength() {
    var remaining = 5000 - descriptionField.value.length;

    if(remaining >= 0) {
    	lengthNum.textContent = remaining;
	}
	else {
		lengthNum.textContent = remaining;
		lengthNum.style.color = "red";
	}
}

descriptionField.addEventListener("keyup", checkLength);


function validate_inputs() {
	

    if(descriptionField.value.length > 5000) {
    	alert("the text of the ad is too long");
    	return false;
	}

	if(titleField.value.length > 50) {
    	alert("the title of the ad is too long");
    	return false;
	}

	if (titleField.value.indexOf('"') > -1) {		
  		alert("Please do not insert double quotes in the title (single quotes are accepted)");
  		return false;
	}

	if (descriptionField.value.indexOf('"') > -1) {		
  		alert("Please do not insert double quotes in the description (single quotes are accepted)");
  		return false;
	}


	return true;

}