<!DOCTYPE html>
<html>
<body>
<?php
$database_host = "localhost";
$database_user = "root";
$database_pass = "";
$database_name = "car_rental_m";

$connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
if (mysqli_connect_errno()) {
    die("Failed connecting to MySQL database: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

$res = "SELECT * FROM CHAUFFEUR";
$result = mysqli_query($connection, $res);

echo "<h1><center>Chauffeurs</center></h1><br><br>";
?>

<center>
<table border='1'>
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Age</th>
    <th>Mobile</th>
    <th>License No.</th>
</tr>

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Chid"] . "</td>";
        echo "<td>" . $row["Fname"] . "</td>";
        echo "<td>" . $row["Lname"] . "</td>";
        echo "<td>" . $row["Age"] . "</td>";
        echo "<td>" . $row["Mobile"] . "</td>";
        echo "<td>" . $row["Dlno"] . "</td>";
        echo "</tr>";
    }
}
?>
</table>
</body>
</html>
