<?php

	session_start();
	session_unset();
	session_destroy();

	echo '<script>document.location.href="/eboard/eboard/public/homepage.html"</script>';

?>