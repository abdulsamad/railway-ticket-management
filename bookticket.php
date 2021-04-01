<?php
	require ('./db/conn.php');
	require ('./config.php');
	require ('razorpay-php/Razorpay.php');
  session_start();

	if(!isset($_SESSION['uidorPhone'])){
		header('Location: index.php');
		die("Sorry! You're not logged In.");
	}

	use Razorpay\Api\Api;
	use Razorpay\Api\Errors\SignatureVerificationError;

	$success = true;

	$error = "Payment Failed";

	if (empty($_POST['razorpay_payment_id']) === false)
	{
			$api = new Api($keyId, $keySecret);

			try
			{
					// Please note that the razorpay order ID must
					// come from a trusted source (session here, but
					// could be database or something else)
					$attributes = array(
							'razorpay_order_id' => $_SESSION['razorpay_order_id'],
							'razorpay_payment_id' => $_POST['razorpay_payment_id'],
							'razorpay_signature' => $_POST['razorpay_signature']
					);

					$api->utility->verifyPaymentSignature($attributes);
			}
			catch(SignatureVerificationError $e)
			{
					$success = false;
					$error = 'Razorpay Error : ' . $e->getMessage();
			}
	}

	if ($success === true){
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
				$html = true;
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
				$html = true;
			}
		} else {
			header('Location: index.php');
			die("Sorry! Please enter all your details properly.");
		}
	} else{
		$html = false;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ticket Confirmation</title>
</head>
<body>	
  <?php echo $html ? 'Ticket Booking Success' : 'Ticket Booking Failed' ?>
</body>
</html>