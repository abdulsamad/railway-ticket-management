<?php
	require ("./db/conn.php");
   require ('./config.php');
	require ('razorpay-php/Razorpay.php');
   session_start();

   if(!isset($_SESSION['uidorPhone'])){
      header('Location: index.php');
   }

	use Razorpay\Api\Api;
   
	$api = new Api($RazorpayKeyId, $RazorpayKeySecret);
	$orderData = [
		'receipt'         => 3456,
		'amount'          => mt_rand(10, 1000) * 100,
		'currency'        => 'INR',
		'payment_capture' => 1
	];
	$razorpayOrder = $api->order->create($orderData);
	$razorpayOrderId = $razorpayOrder['id'];
	$_SESSION['razorpay_order_id'] = $razorpayOrderId;
	$displayAmount = $amount = $orderData['amount'];
	$data = [
		"key"               => $RazorpayKeyId,
		"amount"            => $amount,
		"name"              => "Rail Mumbai",
		"description"       => "Dummy Mumbai railway ticket booking site.",
		"image"             => "https://source.unsplash.com/60x60/?railway",
		"notes"             => [
		"address"           => "New Street, Old House, Random Colony",
		"merchant_order_id" => "12312321",
		],
		"order_id"          => $razorpayOrderId,
	];

	$json = json_encode($data);
   $_SESSION['amount'] = $amount / 100;
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>RailMumbai</title>
   <link rel="shortcut icon" href="assets/favicon.png">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
   <script>
      const options = <?php echo $json?>;
   </script>
</head>

<body>
   <div class="loader" id="loader">
		<div class="spinner-border text-success" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>

   <div class="d-none" id="main">
      <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
         <div class="container">
            <a class="navbar-brand" href="index.php">RailMumbai</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
               aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link text-light" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-light" href="#ticket">Book Now</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-light" href="#pass">Local Pass</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-light" href="transactions.php">Transactions</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-light" href="#feature">Features</a>
                  </li>
                  <li class="nav-item ml-lg-5">
                     <a class="nav-link text-light" href="logout.php">
                     <svg fill="#f1f1f1" width="24" height="24" viewBox="0 0 24 24"><path d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-16-7v20h14v-2h-12v-16h12v-2h-14z"/></svg>
                     Logout</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

      <!-- start banner Area -->
      <section class="banner-area jumbotron position-relative" id="home">
         <div class="overlay position-absolute"></div>
         <div class="container">
            <div class="banner-content position-relative d-flex flex-column align-items-center justify-content-center">
               <h2 class="text-white display-4">Welcome to RailMumbai</h2>
               <p class="text-white mt-3 mb-5">
                  Quick Mumbai Local Train Booking
               </p>
            </div>
         </div>
      </section>

      <!-- Start convert Area: Ticket -->
      <section class="convert-area mb-5 position-relative" id="ticket">
         <div class="container">
            <form name="razorpayticketform" action="bookticket.php" method="POST">
               <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_ticket">
               <input type="hidden" name="razorpay_signature"  id="razorpay_signature_ticket" >
               <div class="convert-wrap p-5">
                  <div class="row justify-content-center align-items-center flex-column mb-3">
                     <h2 class="text-white">Journey Details</h2>
                  </div>
                  <div class="row justify-content-center align-items-start">
                     <div class="col-lg-4 text-white">
                        <div class="form-group">
                           <label for="source">Source</label>
                           <input type="text" name="source" class="form-control" id="source" placeholder="Source" required>
                        </div>
                        <p>Type</p>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="type" id="journey-single" value="1" checked>
                           <label class="form-check-label" for="journey-single">
                              Single
                           </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="type" id="journey-return" value="2">
                           <label class="form-check-label" for="journey-return">
                              Return
                           </label>
                        </div>
                        <div class="form-group mb-3 mt-2">
                           <input type="number" name="number" class="form-control" placeholder="Number Of Ticket" value="1" required>
                        </div>
                        <div class="form-group">
                           <label for="via">Via</label>
                           <select name="via" class="form-control" id="via" required>
                              <option value="none">none</option>
                              <option value="Thane">Thane</option>
                              <option value="Vashi">Vashi</option>
                              <option value="Snpd">Snpd</option>
                              <option value="Dadar">Dadar</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-4 text-white">
                        <div class="form-group">
                           <label for="destination">Destination</label>
                           <input type="text" name="destination" class="form-control" id="destination" placeholder="Destination" required>
                        </div>
                        <p>Class</p>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="class" id="first" value="1">
                           <label class="form-check-label" for="first">
                              First
                           </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="class" id="second" value="2" checked>
                           <label class="form-check-label" for="second">
                              Second
                           </label>
                        </div>
                        <div class="form-group mb-3 mt-2">
                           <input type="datetime-local" name="boarding_time" class="form-control mb-2 mt-2"
                              placeholder="Boarding Time (e.g HH:MM:SS)" required>
                        </div>                        
                        <button class="btn btn-success btn-block my-5" id="rzp-ticket-button">Book Now</button>
                     </div>
                     <br>
                  </div>
               </div>
            </form>
         </div>
      </section>

      <!-- Start convert Area: Pass -->
      <section class="simple-service-area mb-5" id="pass">
         <div class="container">
            <form name="razorpaypassform" action="bookpass.php" method="POST">
               <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_pass">
               <input type="hidden" name="razorpay_signature"  id="razorpay_signature_pass" >
               <div class="convert-wrap p-5">
                  <div class="row justify-content-center align-items-center flex-column mb-3">
                     <h2 class="text-white">Pass Details</h2>
                  </div>
                  <div class="row justify-content-center align-items-start">
                     <div class="col-lg-4 text-white">
                        <div class="form-group">
                           <label for="source">Source</label>
                           <input type="text" name="source" class="form-control" id="source" placeholder="Source" required>
                        </div>
                        <p>Class</p>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="class" id="pass-single" value="1" checked>
                           <label class="form-check-label" for="pass-single">
                              First
                           </label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                           <input class="form-check-input" type="radio" name="class" id="pass-return" value="2">
                           <label class="form-check-label" for="pass-return">
                              Second
                           </label>
                        </div>
                        <div class="form-group">
                           <label for="via">Via</label>
                           <select name="via" class="form-control" id="via">
                              <option value="none">none</option>
                              <option value="Thane">Thane</option>
                              <option value="Vashi">Vashi</option>
                              <option value="Snpd">Snpd</option>
                              <option value="Dadar">Dadar</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-4 text-white">
                        <div class="form-group">
                           <label for="destination">Destination</label>
                           <input type="text" name="destination" class="form-control" id="destination"
                              placeholder="Destination" required>
                        </div>
                        <p>Duration</p>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="duration" id="monthly" value="1" checked>
                           <label class="form-check-label" for="monthly">
                              Monthly
                           </label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="duration" id="quaterly" value="2">
                           <label class="form-check-label" for="quaterly">
                              Quaterly
                           </label>
                        </div>
                        <button class="btn btn-success btn-block my-5" id="rzp-pass-button">Book Now</button>
                     </div>
                     <br>
                  </div>
               </div>
            </form>
         </div>
      </section>

      <!-- Start service Area -->
      <section class="service-area mb-5" id="feature">
         <div class="container">
            <div class="row d-flex justify-content-center">
               <div class="menu-content pb-60 col-lg-8">
                  <div class="title text-center">
                     <h2 class="mb-3">Why Choose RailMumbai to Book Local Tickets ?</h2>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <h4 class="my-2">Easy To Use</h4>
               <ul class="list-group my-4">
                  <li class="list-group-item">Search train and fares easily</li>
                  <li class="list-group-item">Quick and easy Ticketing</li>
                  <li class="list-group-item">Avoid ticket queues at the station</li>
                  <li class="list-group-item">Head straight to your train</li>
               </ul>
            </div>
            <div class="col-sm-6">
               <h4 class="my-2">Book On The Go</h4>
               <ul class="list-group my-4">
                  <li class="list-group-item">Buy tickets up to 10 mins before departure</li>
                  <li class="list-group-item">Buy mobile tickets directly from the app</li>
               </ul>
            </div>
         </div>
         <!--grid view end-->
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
               </div>
            </div>
      </section>
   </div>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/bookticket.js"></script>
   <script src="js/bookpass.js"></script>
   <script src="js/main.js"></script>
</body>

</html>