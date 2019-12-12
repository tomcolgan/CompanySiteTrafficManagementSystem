<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = 'root';
$dbname = "vehicle_info";
$conn = new mysqli($mysql_host, $mysql_user, $mysql_password);
// Selecting the DB 
 mysqli_select_db($conn,"vehicle_info");
echo "<html><head>
<link rel = 'icon' href = 'css.jpg' type = 'image/icon type'>
<link rel = 'stylesheet' type = 'text/css' href = 'mycss.css'>
  <title>Record Deletion</title>
</head>";
$DATA_ID = $_POST["deletes"];

$sql = "UPDATE vehicle_info_actual SET STATUS = 'I' WHERE STATUS = 'A' AND DATE(DATE_TIME) = DATE(CURRENT_TIMESTAMP) AND DATA_ID = $DATA_ID";
if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "UPDATE vehicle_info SET STATUS = 'I' WHERE STATUS = 'A' AND DATA_ID = $DATA_ID";
if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
else {  
	echo "The record deleted Successfully";	
}
echo "<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
<form action = 'delete.php'>
<center><input type='submit' value = 'DELETE ANOTHER'></center>
</form>
";
?>
