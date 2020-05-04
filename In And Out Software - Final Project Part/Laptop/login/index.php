<?php
	session_start();
	if(isset($_SESSION["user"])){
		header('location: ../dashboard');
	}
	if(isset($_GET["action"])){
		if($_GET["action"]=="login"){
			if(isset($_POST["login"]) && isset($_POST["password"])){
				require_once "../assets/classes/user.php";
				$user=new user();
				$nb=$user->login($_POST["login"],$_POST["password"]);
				if($nb != 0){
					$_SESSION["user"]=$_POST["login"];
					header('location: ../dashboard/');
				}else
				{
					header('location: ?error=data');
				}
	
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<script src="js/jquery 1.5.min.js"></script>
<script src="js/modernizr.js"></script>
<script> 
	$(window).load(function() { 
		$(".se-pre-con").fadeOut("slow");;
	});
</script>
	<style>
		.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(images/loading.gif) center no-repeat #fff;
}
	</style>
</head>
<body>
<div class="se-pre-con"></div>
<div class="content">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post" action="?action=login" >

					<span class="login100-form-title p-b-48">
						<img src="images/login.png" width="40%"/>
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="login" autocomplete="off">
						<span class="focus-input100" data-placeholder="login"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="phone number">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" autocomplete="off">
						<span class="focus-input100" data-placeholder="password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<input class="login100-form-btn " style="background-color:#55b2d2;" type="submit" name="submit" value="log in">
								
						</div>
					</div>
					<div class="col-md-6">
						<?php if(isset($_GET["error"])){
							if($_GET["error"]=="data"){
								?>
									<span style="color:red">Login or password are incorrect !</span>
								<?php
							}else if ($_GET["error"]=="login"){
								?>
									<span style="color:red">You have to log in first!</span>
								<?php
							}
						}?>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
</div>	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>