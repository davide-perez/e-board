// fields to check
var descriptionField = document.getElementById("description");
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