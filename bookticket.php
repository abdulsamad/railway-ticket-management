<?php
  session_start();

	if(!isset($_SESSION['uidorPhone'])){
		header('Location: index.php');
		die("Sorry! You're not logged In.");
	}

	if($_POST['source'] && $_POST['type'] && $_POST['number'] && $_POST['via'] &&	$_POST['destination'] && $_POST['class'] && $_POST['boarding_time']){
		echo "Everthing was Submitted!";
	} else {
		echo "Submission not Proper";
	}
?>