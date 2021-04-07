<?php
	require ("./db/conn.php");
	
	if (isset($_POST['uid']) && isset($_POST['phone']) && isset($_POST['password'])){
		$uid = stripslashes($_POST['uid']);
		$uid = mysqli_real_escape_string($conn, $uid); 
		$phone = stripslashes($_POST['phone']);
		$phone = mysqli_real_escape_string($conn, $phone);
		$password = stripslashes($_POST['password']);
		$password = mysqli_real_escape_string($conn, $password);
		$trn_date = date("Y-m-d H:i:s");

		$sql=mysqli_query($conn, "SELECT * FROM users WHERE uid='$uid' OR phone='$uid'");
		
		if(mysqli_num_rows($sql)>=1){
			echo "<div class='alert alert-danger mb-0' role='alert'>
							Sorry! User with same UID or Phone already exists.
						</div>";
		} else {
			$query = "INSERT into `users` (uid, password, phone, trn_date) VALUES ('$uid', '".md5($password)."', '$phone', '$trn_date')";
			$result = mysqli_query($conn, $query);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RailMumbai Registration</title>
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

		<div class="container my-2">
			<h1>Register</h1>
		</div>


		<form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST">
			<div class="container">
				<?php
				if(isset($result)){
					if($result){
						echo "<div class='alert alert-success' role='alert'>
										You're successfully regitered! Please <a href='index.php'>login</a> to continue.
									</div>";
					} else {
						echo "<div class='alert alert-danger' role='alert'>
										Sorry! Account creation failed.
									</div>";
					}
				}
				?>
				<div class="input-group flex-nowrap my-4">
					<div class="input-group-prepend">
						<span class="input-group-text">🆔</span>
					</div>
					<input type="text" name="uid" class="form-control" placeholder="UID" required>
				</div>
				<div class="input-group flex-nowrap my-4">
					<div class="input-group-prepend">
						<span class="input-group-text">📱</span>
					</div>
					<input type="number" name="phone" class="form-control" placeholder="Phone" required>
				</div>
				<div class="input-group flex-nowrap my-4">
					<div class="input-group-prepend">
						<span class="input-group-text">🔒</span>
					</div>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
				<div class="mb-3">
					<p class="text-muted">Already have an account. <a href="index.php">LogIn Now</a></p>
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>