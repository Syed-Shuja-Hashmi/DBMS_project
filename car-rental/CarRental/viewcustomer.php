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

	// Query to get all customers
	$res = "SELECT * FROM customer";
	$result = mysqli_query($connection, $res);

	// Display the title
	echo "<h1><center>Customers</center></h1><br><br>";
?>
<center>
<table border='1'>
<tr>
    <th>FName</th>
    <th>Lname</th>
    <th>Age</th>
    <th>Mobile</th>
    <th>Dl No.</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and display customer data
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Fname"] . "</td>";
        echo "<td>" . $row["Lname"] . "</td>";
        echo "<td>" . $row["AGE"] . "</td>";
        echo "<td>" . $row["Mobile"] . "</td>";
        echo "<td>" . $row["Dlno"] . "</td>";
        echo "</tr>";
    }
}
?>
</table>
</body>
</html>
