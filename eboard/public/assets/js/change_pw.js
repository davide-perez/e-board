$('#change_button').click(function validatePW(event) {
	var oldPw = document.getElementById("oldpw");
	var pwField = document.getElementById("inputPassword");
	var repeatField = document.getElementById("repeatPassword");


	if(!oldPw.checkValidity())
        alert("Please insert your old password");
    else if(!pwField.checkValidity())
        alert("Please insert a new password");
    else if(!repeatField.checkValidity())
        alert("Please repeat your new password");

	else if (pwField.value == repeatField.value) {

		var $form = $('#pwForm');
		var $inputs = $form.find("input");
		var serializedData = $form.serialize();

		request = $.ajax({
			url: "/eboard/eboard/server/php/pw_checker.php",
			type: "post",
			data: serializedData
		});


		request.done(function(response, textStatus, jqXHR){

			if (response == "not_existing") {
				
				alert("The old password that you inserted is not correct");
				document.getElementById("oldpwLabel").style.color = "red";
			}
			else {
				alert("Password changed correctly");
				$form.submit();
			}
		});
	}

	else {
		alert("Please repeat your new password correctly");
	}	



});