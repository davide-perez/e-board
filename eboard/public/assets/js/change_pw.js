$('#change_button').click(function validatePW(event) {

	console.log("almeno qui");
	var pwField = document.getElementById("inputPassword");
	var repeatField = document.getElementById("repeatPassword");

	if (pwField.value == repeatField.value) {

		var $form = $('#pwForm');
		var $inputs = $form.find("input");
		var serializedData = $form.serialize();

		request = $.ajax({
			url: "/eboard/eboard/server/php/pw_checker.php",
			type: "post",
			data: serializedData
		});


		request.done(function(response, textStatus, jqXHR){

			console.log("entrato");
			console.log(response);
			if (response == "not_existing") {
				// avoid the change of page
				console.log("entrato di nuovo");
				

				alert("The old password that you inserted is not correct");
				document.getElementById("oldpwLabel").style.color = "red";
			}
			else {
				alert("Password changed correctly");
				console.log("noooo");
				$form.submit();
			}
		});
	}

	else {
		alert("Please repeat your new password correctly");
		return false;
	}	



});