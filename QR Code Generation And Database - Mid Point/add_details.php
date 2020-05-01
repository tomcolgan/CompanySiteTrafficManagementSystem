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
  <title>Record Addition</title>
</head>";
echo "<br>";
 
 mysqli_select_db($conn,"vehicle_info");
 
    $VEHICLE_REG_NUMBER = $_POST["VEHICLE_REG_NUMBER"];
	$DRIVER_NAME = $_POST["DRIVER_NAME"];
	$PURPOSE = $_POST["PURPOSE"];
	$sql = "INSERT INTO vehicle_info (VEHICLE_REG_NUMBER,DRIVER_NAME,PURPOSE) VALUES ('$VEHICLE_REG_NUMBER','$DRIVER_NAME','$PURPOSE')";
 
 if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO vehicle_info_actual (DATA_ID,VEHICLE_REG_NUMBER,DRIVER_NAME,PURPOSE) SELECT DATA_ID,VEHICLE_REG_NUMBER,DRIVER_NAME,PURPOSE FROM vehicle_info WHERE DATA_ID = (SELECT MAX(DATA_ID) FROM vehicle_info where STATUS = 'A')";

if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    
	echo "New record created Successfully";
	
}
echo "<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
<form action = 'add.php'>
<center><input type='submit' value = 'ADD ANOTHER'></center>
</form>"
;

$conn->close();
 
 
?>