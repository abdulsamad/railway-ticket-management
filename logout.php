<?php
	session_start();

	// Destroying All Sessions
	if(session_destroy()){
		header("Location: index.php");
	}
?>