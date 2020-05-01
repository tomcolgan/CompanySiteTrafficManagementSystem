<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'root';
$dbname = "vehicle_info";
$conn = new mysqli($mysql_host, $mysql_user, $mysql_password);
// Selecting the DB 
 mysqli_select_db($conn,"vehicle_info");

$DATA_ID = $_POST["updates"];
$sql = "SELECT VEHICLE_REG_NUMBER, DRIVER_NAME, PURPOSE FROM vehicle_info_actual WHERE STATUS = 'A' AND DATE(DATE_TIME) = DATE(CURRENT_TIMESTAMP) AND DATA_ID = $DATA_ID";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	
	
	$VEHICLE_REG_NUMBER = $row["VEHICLE_REG_NUMBER"];
	$DRIVER_NAME = $row["DRIVER_NAME"];
	$PURPOSE = $row["PURPOSE"];	
	
}
echo "
<html>
<head>
<link rel = 'icon' href = 'css.jpg' type = 'image/icon type'>
<link rel = 'stylesheet' type = 'text/css' href = 'mycss.css'>
  <title>Record Updation</title>
</head>
<body>
<form action = 'update_submit.php' method='post'>
<center>
<p>
<label>DATA_ID<input type = 'text' name = 'DATA_ID' value = $DATA_ID readonly>

<p>
<label>VEHICLE_REG_NUMBER
<input type='text' name='VEHICLE_REG_NUMBER' value = $VEHICLE_REG_NUMBER>
</label> 
</p>
<p>
<label>DRIVER_NAME 
<input type='text' name='DRIVER_NAME' value = $DRIVER_NAME>
</label>
</p>
<p>PURPOSE
<input type='text' name='PURPOSE' value = $PURPOSE>
</label>
</p>
<br>
</center>
<center><input type='submit' value = 'SUBMIT'>&nbsp &nbsp &nbsp &nbsp &nbsp <input type='reset' value = 'CLEAR'></center>
</form>
<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
</body>
</html>";

?> 
