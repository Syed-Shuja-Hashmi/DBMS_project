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
	$Drate=$_POST["udrate"];
	$Wrate=$_POST["uwrate"];
	$Ctype=$_POST["Ctype"];
	if(isset($_POST["udrate"]) AND isset($_POST["uwrate"])) {
		$res = "UPDATE rates AS R 
        JOIN car AS C ON R.Vehicle_id = C.Vehicle_id 
        SET R.Daily_Rate = $Drate, R.Weekly_Rate = $Wrate 
        WHERE C.Ctype = '$Ctype'"; 
	}
	$result=mysqli_query($connection,$res);
	echo "<h1><center>".$Ctype."&nbsp;Rates updated</h1><br><br>";
?>

</table>
</body>
</html>


