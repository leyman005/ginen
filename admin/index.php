<?php 
	// session_start();
	// include 'function/function.php'; 
	// echo generate_token();
	// echo '<pre>'; print_r($_SESSION['token']); echo '</pre>';
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <!-- <link rel="stylesheet" href="assets/css/cs-skin-elastic.css"> -->
	<link rel="stylesheet" href="css/admin-style.css">

	<title>Ginen</title>
</head>
<body>
	<div id="bar">
		<div class="container">
			<a href="http://www.ginen.co.za">Go to Ginen</a>
		</div>
	</div>
	<div class="container">

		<form action="ajax/login.php" method="post">

			<img src="../images/logo.png" width="210" height="80">
			<hr><br/>

			<!-- <div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-home"></i></div>
					<input class="form-control" type="text" id='txtusername' name='txtusername' required>
				</div>
			</div> -->

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<input class="form-control" type="text" id='txtusername' name='txtusername' required>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock"></i></div>
					<input class="form-control"  type="password" id='txtpassword' name='txtpassword' required>
				</div>
			</div>

	
			<input type="submit" value='Login'><i id="sign-in" class="fa fa-sign-in"></i>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="js/main.js"></script>
</body>
</html>