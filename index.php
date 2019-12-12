<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'root';
$dbname = "vehicle_info";
$conn = new mysqli($mysql_host, $mysql_user, $mysql_password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<html><head>
<link rel = 'icon' href = 'css.jpg' type = 'image/icon type'>
<link rel = 'stylesheet' type = 'text/css' href = 'mycss.css'>
  <title img = 'css.jpg'>Welcome To QR Code Generation</title>
</head>";
echo "<br><br><br>";
 
 mysqli_select_db($conn,"vehicle_info");
 
 // To copy daily wise data to the vehicle_info_actual table
 $sql = "call actual_data_copy()";
 if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT DATA_ID, VEHICLE_REG_NUMBER, DRIVER_NAME, PURPOSE, DATE_TIME FROM vehicle_info_actual WHERE STATUS = 'A' AND DATE(DATE_TIME) = DATE(CURRENT_TIMESTAMP) order by DATA_ID";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	echo "<html> 
 
</head> 

<body> 
<center>
<h2>QR Code - Administrator</h2></center>
<form action = 'generate_qr.php' method = 'post'>
<table style='width:70%' align = 'center'>
	
		<tr> 
			<th>DATE</th>
			<th>VEHICLE_REG_NUMBER</th>
			<th>DRIVER_NAME</th>
			<th>PURPOSE OF VISIT</th> 
			<th>QR_CODE</th>
		</tr> ";
		
while($row = $result->fetch_assoc()) {
	
	$DATA_ID = $row["DATA_ID"];
	$VEHICLE_REG_NUMBER = $row["VEHICLE_REG_NUMBER"];
	$DRIVER_NAME = $row["DRIVER_NAME"];
	$PURPOSE = $row["PURPOSE"];
	$DATE_TIME = $row["DATE_TIME"];
	
	echo
	"<tr> 
			<td>$DATE_TIME</td>
			<td>$VEHICLE_REG_NUMBER</td> 
			<th>$DRIVER_NAME</th>
			<td>$PURPOSE</td>
			<td><input type = 'radio' name = 'qr_code' value = $DATA_ID required></td>
		</tr> ";
}
echo 
"</table>
<br><br>
<center><input type='submit' value = 'GENERATE QR'>&nbsp &nbsp &nbsp &nbsp<input type='reset' value = 'CLEAR'></center>
</form>
<br>
<center>
<form action = 'add.php' method = 'post'>
<input type='submit' value = 'ADD'>
</form>
<form action = 'delete.php' method = 'post'>
<input type='submit' value = 'DELETE'>
</form>
<form action = 'update.php' method = 'post'>
<input type='submit' value = 'UPDATE'>
</form>
<form action = 'history.php' method = 'post'>
<input type='submit' value = 'HISTORY'>
</form>
</form>
</center>
</body> 
</html>";
}
?>