<?php
session_start();
    if(! isset($_SESSION["user"])){
		header('location: ../login/?error=login');
    }
    if(isset($_GET["action"]) ){
       if($_GET["action"]== "update"){
            if(isset($_POST["pwd"]) && isset($_POST["old"]) && isset($_POST["confirm"])){
                require_once "../assets/classes/user.php";
                $user=new user();
                if(strcmp($user->getPassword($_SESSION["user"]),$_POST["old"]) != 0)
                    {
                        header('location: ?error=oldPwd');
                    }
                else if(strcmp($_POST["pwd"],$_POST["confirm"]) != 0)
                    {
                        header('location: ?error=confirm');
                    }
                else if(strcmp($_POST["pwd"],$_POST["old"]) == 0)
                    {
                        header('location: ?error=same');
                    }
                else
                {
                    $user->updatePassword($_SESSION["user"],$_POST["pwd"]);
                    header('location: ../dashboard');
                }
                
            }
        } 
    }
    
?>
<head>

<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" media='all' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- password check for length of password, passwords need to match -->
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        
    } );

    $('#pwd, #confirm').on('keyup', function () {
        if ($('#pwd').val().length <5 ) {
    $('#message').html('Use 5 characters or more for your password').css('color', 'red');
    $('#create').attr("disabled", true);
  }else
  if ($('#pwd').val() == $('#confirm').val() ) {
    $('#message').html("passwords match").css('color', 'green');
    $('#create').attr("disabled", false);
  }else if($('#pwd').val() == '' || $('#confirm').val() == '' ){
    {
        $('#message').html('Enter a password').css('color', 'red');
        $('#create').attr("disabled", true);	
    }
  } else 
    {
        $('#message').html("Those passwords didn't match. try again ").css('color', 'red');
        $('#create').attr("disabled", true);	
    }
});
} );
</script>
<style>
.dot {
  height: 25px;
  width: 25px;
  
  border-radius: 50%;
  display: inline-block;
}
html, body{overflow-x: hidden;}

</style>
<!-- get current date -->
<script>
    $(document).ready(function(){
        ajax_call=function(){
			$.ajax({
				type: "GET",
				url: "currentDate.php",
				dataType: "html",
				success: function(response){
					$("#currentDate").html(response);	
				}
			});
        }
        
            var intervalle=1000;
		setInterval(ajax_call,intervalle);
    });
</script>
<!-- using style -->
<script src="js/modernizr.js"></script>
<script> 
	$(document).ready(function(){
		$(".se-pre-con").fadeOut(2000);;
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
<html>
<body>
<div class="se-pre-con"></div>
<div class="content">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><i class="fa fa-home"></i>  In Out System</a>
    </div>
    <div class="dropdown" style="float:right;margin-right:10%;">
        <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user">  Thomas Colgan</i>
        <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="settings.php">Settings</a></li>
                <li><a href="../logout.php">Sign out</a></li>
            </ul>
    </div>
  </div>
  
</nav>
<!-- changing password -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <h3>Change Password</h3>
            <form action="?action=update" method="post">
                <div class="row">
                    <div class="form-group">
                        <label for="email">Old Password:</label>
                        <input type="password" class="form-control" id="old" placeholder="Enter old password" name="old">
                        <?php if(isset($_GET["error"])) {if($_GET["error"] == "oldPwd") echo "<span style='color:red'>The old password you have entered is incorrect</span>";}?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="pwd">New Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter new password" name="pwd">
                        <?php if(isset($_GET["error"])) {if($_GET["error"] == "same") echo "<span style='color:red'>Enter a new password ! </span>";}?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm" placeholder="confirm password" name="confirm">
                    </div>
                </div>
                <?php if(isset($_GET["error"])) {if($_GET["error"] == "confirm") echo "<span style='color:red'>Those passwords didn't match. try again </span>";}?>
                <span id="message"></span>

                <div class="row">
                    <button type="submit" class="btn btn-default" id="create" disabled>update password</button>
                </div>
            </form>
        </div>
    </div>

    

</div>
</body>
</html>