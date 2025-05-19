<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<?php
	$database_host = "localhost";
	$database_user = "root";
	$database_pass = "";
	$database_name = "car_rental_m";
	$connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
	if(mysqli_connect_errno()){
		die("Failed connecting to MySQL database. Invalid credentials" . mysqli_connect_error(). "(" .mysqli_connect_errno(). ")" ); }
	$res = "SELECT DISTINCT Owner_id, (rental.Nodays * rates.Daily_Rate + rental.Noweeks * rates.Weekly_Rate) AS Amount FROM rental JOIN rates ON rental.Vehicle_id = rates.Vehicle_ID JOIN owns ON rental.Vehicle_id = owns.Vehicle_id GROUP BY Owner_id"; 
	$result = mysqli_query($connection, $res); 
	echo "<h1><center>Profits according to owners</center></h1><br><br>"; 
	?> 
	<center> 
	<table border='1'> 
	<tr><th>Owner id</th>
	<th>Amount</th>
	</tr> 
<?php 
while ($row = mysqli_fetch_assoc($result)) { 
	echo "<tr><td>{$row["Owner_id"]}</td><td>{$row["Amount"]}</td></tr>";
	 } 
?> 
</table>
</body>
</html>