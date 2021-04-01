<?php
	require ('./db/conn.php');
  session_start();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(!isset($_SESSION['uidorPhone'])){
		header('Location: index.php');
		die("Sorry! You're not logged In.");
	}

	
	if($_POST['source'] && $_POST['type'] && $_POST['number'] && $_POST['via'] &&	$_POST['destination'] && $_POST['class'] && $_POST['boarding_time']){
		$source = $_POST['source'];
		$type = $_POST['type'];
		$number = (int)$_POST['number'];
		$via = $_POST['via'];
		$destination = $_POST['destination'];
		$class = (int)$_POST['class'];
		$boardingtime = $_POST['boarding_time'];
		$uid = $_SESSION['uidorPhone'];
		$currentTime = strftime("%Y%m%d%H%M%S");
		$uniqueTicketNo = 'Rm'.$currentTime.$_SESSION['uidorPhone'];
		
		$sql = "INSERT INTO ticketbooking (uid, source, destination, via, class, type, no_of_ticket, fare, boarding_time, booking_time, barcode) VALUES ('$uid', '$source', '$destination', '$via', '$class', '$type', '$number', 255, '$boardingtime', '$currentTime', '$uniqueTicketNo')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
		header('Location: index.php');
		die("Sorry! Please enter all your details properly.");
	}
?>