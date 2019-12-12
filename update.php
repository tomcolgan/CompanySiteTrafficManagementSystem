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
//echo "Connected successfully";
echo "<html><head>
<link rel = 'icon' href = 'css.jpg' type = 'image/icon type'>
<link rel = 'stylesheet' type = 'text/css' href = 'mycss.css'>
  <title>Update A Record</title>
</head>";
echo "<br>";
 
 mysqli_select_db($conn,"vehicle_info");
 
$sql = "SELECT DATA_ID, VEHICLE_REG_NUMBER, DRIVER_NAME, PURPOSE, DATE_TIME FROM vehicle_info_actual WHERE STATUS = 'A' AND DATE(DATE_TIME) = DATE(CURRENT_TIMESTAMP) order by DATA_ID";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
	echo "<html> 

<head> 
	<style> 
		table, th, td { 
			border: 1px solid black; 
			border-collapse: collapse; 
		} 
		
		th, td { 
			padding: 10px; 
		} 
		
		th, td { 
			text-align: center; 
		} 
	</style> 
</head> 

<body> 
<form action = 'update_details.php' method = 'post'>
<table style='width:50%' align = 'center'>
	
		<caption>UPDATE TABLE</caption> 
		<tr> 
			<th>DATE</th>
			<th>VEHICLE_REG_NUMBER</th>
			<th>DRIVER_NAME</th>
			<th>PURPOSE</th> 
			<th>UPDATE</th>
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
			<td><input type = 'radio' name = 'updates' value = $DATA_ID required></td>
		</tr> ";
}
echo 
"</table>
<br><br>
<center><input type='submit' value = 'UPDATE'>&nbsp &nbsp &nbsp &nbsp &nbsp<input type='reset' value = 'CLEAR'></center>
</form>
<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
</body> 
</html>";
}
 
 
 
?>