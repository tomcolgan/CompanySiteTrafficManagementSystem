<?php
echo "
<html>
<head>
<link rel = 'stylesheet' type = 'text/css' href = 'mycss.css'>
<link rel = 'icon' href = 'css.jpg' type = 'image/icon type'>
  <title>Add New Record</title>
</head>
<body>
<form action = 'add_details.php' method='post'>
<center>
<p>
<label>VEHICLE_REG_NUMBER
<input type='text' name='VEHICLE_REG_NUMBER' required>
</label> 
</p>
<p>
<label>DRIVER_NAME 
<input type='text' name='DRIVER_NAME' required>
</label>
</p>
<p>PURPOSE
<input type='text' name='PURPOSE' required>
</label>
</p>
<br>
</center>
<center><input type='submit' value = 'ADD DETAILS'>&nbsp &nbsp &nbsp &nbsp &nbsp <input type='reset' value = 'CLEAR'></center>
</form>
<br>
<form action = 'index.php'>
<center><input type='submit' value = 'GO TO HOME'></center>
</form>
</body>
</html>";

?>