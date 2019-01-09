$('#pwForm').submit(function validate(event) {
	// avoid the change of page
	event.preventDefault();

	var $form = $(this);
	var $inputs = $form.find("input");
	var serializedData = $form.serialize();

	request = $.ajax({
		url: "pw_checker.php",
		type: "post",
		data: serializedData
	});

	request.done(function(response, textStatus, jqXHR){
		// to do control
		console.log(response);
	});



});