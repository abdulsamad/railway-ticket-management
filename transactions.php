<?php
	require ("./db/conn.php");
	require ("./phpqrcode/qrlib.php");
	session_start();

	$uid = $_SESSION['uidorPhone'];
	$sql = "SELECT * FROM ticketgeneration WHERE uid='$uid'";
	$result = $conn->query($sql);

	$sql1 = "SELECT * FROM passgeneration WHERE uid='$uid'";
	$result1 = $conn->query($sql1);

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
				<form id="filter-form">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="table-filter" id="ticketFilter1" value="ticket" checked>
						<label class="form-check-label" for="ticketFilter1">
						Normal Ticket
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="table-filter" id="ticketFilter2" value="pass">
						<label class="form-check-label" for="ticketFilter2">
							Rail Pass
						</label>
					</div>
					<div class="mt-4">
						<button type="submit" class="btn btn-primary" role="button">Transaction</button>
					</div>
				</form>
			</div>
		</div>

		<div class="container my-5">
			<div id="ticket-table">
				<?php 
					if($result-> num_rows > 0 ){	
				?>
					<table class="table table-striped table-bordered table-responsive text-center">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Uid</th>
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
					<?php
						while ($row = $result -> fetch_assoc()){ ?>
								<tr>
									<td class="table-content"><?php echo $row['uid'] ?></td>
									<td class="table-content"><?php echo $row['ticket_no'] ?></td>
									<td class="table-content"><?php echo $row['source'] ?></td>
									<td class="table-content"><?php echo $row['destination'] ?></td>
									<td class="table-content"><?php echo $row['class'] == '1' ? 'First' : 'Second' ?></td>
									<td class="table-content"><?php echo $row['type'] == '1' ? 'Single' : 'Return' ?></td>
									<td class="table-content"><?php echo $row['no_of_ticket'] ?></td>
									<td class="table-content"><?php echo $row['fare'] ?></td>
									<td class="table-content"><?php echo $row['boarding_time'] ?></td>
									<td class="table-content"><?php echo $row['booking_time'] ?></td>
									<td class="table-content">
										<?php
												$file = 'temp/'.$row['ticket_no'].'.png';
												QRcode::png($row['ticket_no'], $file, 'H', 10, 2);
										?>
										<img height="24" width="24" src="temp/<?php echo $row['ticket_no'] ?>.png" alt="Ticket QR Code">
									</td>
								</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					<?php
							} else {
								echo "<h2 class='text-center'>Sorry! No Data Available.</h2>";
							}
					?>	
			</div>
			<div id="pass-table">
				<?php 
					if($result1-> num_rows > 0){	
				?>
					<table class="table table-striped table-bordered table-responsive text-center">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Uid</th>
								<th scope="col">Ticket No</th>
								<th scope="col">Source</th>
								<th scope="col">Destination</th>
								<th scope="col">Class</th>
								<th scope="col">Fare</th>
								<th scope="col">Valid Till</th>
								<th scope="col">Booking Time</th>
								<th scope="col">QR Code</th>
							</tr>
						</thead>
						<tbody> 
					<?php
						while ($row1 = $result1 -> fetch_assoc()){ ?>
								<tr>
									<td class="table-content"><?php echo $row1['uid'] ?></td>
									<td class="table-content"><?php echo $row1['ticket_no'] ?></td>
									<td class="table-content"><?php echo $row1['source'] ?></td>
									<td class="table-content"><?php echo $row1['destination'] ?></td>
									<td class="table-content"><?php echo $row1['class'] == '1' ? 'First' : 'Second' ?></td>
									<td class="table-content"><?php echo $row1['fare'] ?></td>
									<td class="table-content"><?php echo $row1['valid_to'] ?></td>
									<td class="table-content"><?php echo $row1['booking_time'] ?></td>
									<td class="table-content">
										<?php
												$file = 'temp/'.$row1['ticket_no'].'.png';
												QRcode::png($row1['ticket_no'], $file, 'H', 10, 2);
										?>
										<img height="24" width="24" src="temp/<?php echo $row1['ticket_no'] ?>.png" alt="Ticket QR Code">
									</td>
								</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					<?php
							} else {
								echo "<h2 class='text-center'>Sorry! No Data Available.</h2>";
							}
					?>	
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script>
		const form = document.getElementById('filter-form');
		const ticketTable = document.getElementById('ticket-table');
		const passTable = document.getElementById('pass-table');
		
		passTable.style.display = 'none';
		
		form.addEventListener('submit', (ev) => {
			ev.preventDefault();
			
			const tableFilter = document.querySelector('input[name="table-filter"]:checked').value;

			if (tableFilter === 'ticket'){
				passTable.style.display = 'none';
				ticketTable.style.display = 'block';
			} else{
				ticketTable.style.display = 'none';
				passTable.style.display = 'block';
			}
		});
	</script>
</body>

</html>