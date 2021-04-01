<?php
	require ("./db/conn.php");
	session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RailMumbai User Transaction</title>
	<link rel="shortcut icon" href="assets/favicon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="loader" id="loader">
		<div class="spinner-border text-success" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>

	<div class="d-none" id="main">
		<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
			<div class="container">
				<a class="navbar-brand" href="index.php">RailMumbai</a>
			</div>
		</nav>
	
		<div class="container">
			<a href="./index.php" class="btn btn-primary my-5 d-inline-flex align-items-center justify-content-center">
				<svg width="24" height="24" fill-rule="evenodd" clip-rule="evenodd" fill="#fff"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg>
				&nbsp;&nbsp;Back
			</a>
			<div class="jumbotron text-center">
				<h1>Booked Tickets</h1>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="ticketFilter" id="ticketFilter1" value="ticket">
					<label class="form-check-label" for="ticketFilter1">
					Normal Ticket
					</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="ticketFilter" id="ticketFilter2" value="pass">
					<label class="form-check-label" for="ticketFilter2">
						Rail Pass
					</label>
				</div>
				<div class="mt-4">
					<a class="btn btn-primary" href="#" role="button">Transaction</a>
				</div>
			</div>
		</div>

		<div class="container my-5">
			<table class="table table-striped table-bordered table-responsive text-center">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Ticket No</th>
						<th scope="col">Source</th>
						<th scope="col">Destination</th>
						<th scope="col">Class</th>
						<th scope="col">Type</th>
						<th scope="col">No. of Tickets</th>
						<th scope="col">Fare</th>
						<th scope="col">Boarding Time</th>
						<th scope="col">Booking Time</th>
						<th scope="col">QR Code</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="">65666662</td>
						<td class="">EL20414S444</td>
						<td class="">Kurla</td>
						<td class="">Mumbra</td>
						<td class="">1</td>
						<td class="">1</td>
						<td class="">2</td>
						<td class="">210</td>
						<td class="">22:15:52</td>
						<td class="">2018-04-09 18:08:53</td>
						<td class="">
							<img src="https://satyr.io/60x60/1" alt="">
						</td>
					</tr>		
					<tr>
						<td class="">65666662</td>
						<td class="">EL20414S444</td>
						<td class="">Dombivali</td>
						<td class="">Khar</td>
						<td class="">1</td>
						<td class="">1</td>
						<td class="">2</td>
						<td class="">210</td>
						<td class="">22:15:52</td>
						<td class="">2018-04-09 18:08:53</td>
						<td class="">
							<img src="https://satyr.io/60x60/2" alt="">
						</td>
					</tr>		
					<tr>
						<td class="">65666662</td>
						<td class="">EL20414S444</td>
						<td class="">Kurla</td>
						<td class="">Diva</td>
						<td class="">1</td>
						<td class="">1</td>
						<td class="">2</td>
						<td class="">210</td>
						<td class="">22:15:52</td>
						<td class="">2018-04-09 18:08:53</td>
						<td class="">
							<img src="https://satyr.io/60x60/3" alt="">
						</td>
					</tr>		
				</tbody>
			</table>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>