<?php
  session_start();

	if(!isset($_SESSION['uidorPhone'])){
		header('Location: index.php');
		die("Sorry! You're not logged In.");
	}

	if($_POST['source'] && $_POST['type'] && $_POST['via'] &&	$_POST['destination'] && $_POST['duration']){
		echo "Everthing was Submitted!";
	} else {
		echo "Submission not Proper";
	}
?>