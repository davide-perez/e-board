$('#pwForm').submit(function validate(event) {
	event.preventDefault();

	
	var pwField = document.getElementById("inputPassword");
	var repeatField = document.getElementById("repeatPassword");

	if (pwField.value == repeatField.value) {

		var $form = $(this);
		var $inputs = $form.find("input");
		var serializedData = $form.serialize();

		request = $.ajax({
			url: "/eboard/eboard/server/php/pw_checker.php",
			type: "post",
			data: serializedData
		});

		request.done(function(response, textStatus, jqXHR){
			if (response == "not_existing") {
				// avoid the change of page
				alert("The old password that you inserted is not correct");
				document.getElementById("oldpwLabel").style.color = "red";
			}
			else {
				alert("Password changed correctly");
				console.log("noooo");
				$('#pwForm').submit();
			}
		});
	}

	else {alert("Please repeat your new password correctly");}	



});