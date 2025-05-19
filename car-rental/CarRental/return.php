<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<?php
	$database_host = "localhost";
	$database_user = "root";
	$database_pass = "";
	$database_name = "car_rental_m";
	$connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
if (mysqli_connect_errno()) {
    die("Failed connecting to MySQL database. Invalid credentials" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
}

$Rid = $_POST["rid"];

// Get Noweeks and Vehicle_ID from rental
$res = "SELECT Noweeks, Nodays, rental.Vehicle_id 
        FROM rental 
        WHERE rental.rid = '$Rid'";
$result = mysqli_query($connection, $res);
if (!$result || mysqli_num_rows($result) == 0) {
    die("<h2>No rental found with RID $Rid</h2>");
}

$row = mysqli_fetch_assoc($result);
$noweeks = $row["Noweeks"];
$nodays = $row["Nodays"];
$vehicleId = $row["Vehicle_id"];

echo "<h1><center>Amount due</center></h1><br><br>";

if ($noweeks == 0) {
    // Use daily rate
    $res1 = "SELECT $nodays * rates.Daily_Rate AS Amount 
             FROM rates 
             WHERE rates.Vehicle_ID = '$vehicleId'";
    $result1 = mysqli_query($connection, $res1);
    $row1 = mysqli_fetch_assoc($result1);
    echo "<h1>PKR&nbsp" . $row1["Amount"] . "</h1>";
} else {
    // Use weekly rate
    $res2 = "SELECT $noweeks * rates.Weekly_Rate AS Amount 
             FROM rates 
             WHERE rates.Vehicle_ID = '$vehicleId'";
    $result2 = mysqli_query($connection, $res2);
    $row2 = mysqli_fetch_assoc($result2);
    echo "<h1>PKR&nbsp" . $row2["Amount"] . "</h1>";
}

mysqli_close($connection);

?>
</body>
</html>