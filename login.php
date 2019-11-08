<?php
	session_start(); 
	include("db.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<script src="https://kit.fontawesome.com/ee17b9c6d0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-login text-center" action="" method="post">
			<h4 class="form-login-header">Login</h4>
			<input type="text" name="client_email" placeholder="Email" class="form-control email" 
			required>
			<input type="password" name="client_pass" id="client_pass" placeholder="Password" class="form-control" required><br>
			<button class="btn btn-lg btn-primary" type="submit" name="client_login"> Log in 
			</button>
		</form>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>

<?php
	if (isset($_POST['client_login'])) {
	 	$client_email=$_POST['client_email'];
	 	$client_pass=$_POST['client_pass'];

	 	$stmt = $con->prepare('SELECT * FROM accounts WHERE account_email = :account_email');
	 	$stmt->bindParam(':account_email', $client_email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$encrypted_pass = $row['account_pass'];

		$count=$stmt->rowCount();
	 	if ($count==1) {
	 		if (!password_verify($client_pass, $encrypted_pass)) {
	 		echo "<script>alert('Wrong Credentials')</script>";
	 		exit();
	 	}
	 		$_SESSION['client_email']=$client_email;
 			echo "<script>window.open('insert_bestilling.php','_self')</script>";
	 	}
	 	else{
	 		echo "<script>alert('Wrong Credentials')</script>";
	 	}
	 } 
 ?>