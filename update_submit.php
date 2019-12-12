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
  <title>Updation Submit</title>
</head>";
echo "<br>";
 
 mysqli_select_db($conn,"vehicle_info");
 
    $DATA_ID = $_POST["DATA_ID"];
	$VEHICLE_REG_NUMBER = $_POST["VEHICLE_REG_NUMBER"];
	$DRIVER_NAME = $_POST["DRIVER_NAME"];
	$PURPOSE = $_POST["PURPOSE"];
	
	$sql = "UPDATE vehicle_info SET VEHICLE_REG_NUMBER = '$VEHICLE_REG_NUMBER', DRIVER_NAME = '$DRIVER_NAME', PURPOSE = '$PURPOSE' WHERE STATUS = 'A' AND DATA_ID = $DATA_ID";
	 
 if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "UPDATE vehicle_info_actual SET VEHICLE_REG_NUMBER = '$VEHICLE_REG_NUMBER', DRIVER_NAME = '$DRIVER_NAME', PURPOSE = '$PURPOSE' WHERE STATUS = 'A' AND DATE(DATE_TIME) = DATE(CURRENT_TIMESTAMP) AND DATA_ID = $DATA_ID";

if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    
	echo "Record Updated Successfully";
}

echo "<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
<form action = 'update.php'>
<center><input type='submit' value = 'UPDATE ANOTHER'></center>
</form>
";
$conn->close();
 
?>