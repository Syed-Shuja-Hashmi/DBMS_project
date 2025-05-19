<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<?php
// Database connection
$database_host = "localhost";
$database_user = "root";
$database_pass = "";
$database_name = "car_rental_m";
$connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);

// Check for successful connection
if (mysqli_connect_errno()) {
    die("Failed connecting to MySQL database. Invalid credentials" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
}

// Fetching form data
$License_no = $_POST["lno"];
$Model = $_POST["model"];
$Year = $_POST["year"];
$Ctype = $_POST["Cartype"];
$Drate = $_POST["daily_rate"];    // NEW: Daily Rate
$Wrate = $_POST["weekly_rate"];   // NEW: Weekly Rate

$Name1 = $_POST["Carown"];  // Owner type: Individual, Bank, or Company
$Ssn = $_POST["uid"];       // Used only for Individual
$Bid = $_POST["uid"];       // Used only for Bank
$Compid = $_POST["uid"];    // Used only for Company
$Name = $_POST["oname"];    // Owner's Name
$Bname = $_POST["oname"];   // Bank/Company Name
$Cname = $_POST["oname"];   // Company Name
$City = $_POST["city"];     // City for the owner

// Step 1: Insert Car Information
$car_insert_query = "INSERT INTO car (License_no, Model, Year, Ctype) 
                     VALUES ('$License_no', '$Model', '$Year', '$Ctype')";
mysqli_query($connection, $car_insert_query) or die(mysqli_error($connection));

$vehicle_id = mysqli_insert_id($connection); // Get the inserted vehicle ID

// Step 2: Insert Rates
$rate_insert_query = "INSERT INTO rates (Vehicle_id, Daily_Rate, Weekly_Rate)
                      VALUES ('$vehicle_id', '$Drate', '$Wrate')";
mysqli_query($connection, $rate_insert_query) or die("Failed to insert rates: " . mysqli_error($connection));

echo "<h3>New car and rates have been successfully added</h3>";

// Step 3: Insert Owner Information
$owner_id = null;

if ($Name1 == "Individual") {
    $individual_insert_query = "INSERT INTO individual (Ssn, Name, City) 
                                VALUES ('$Ssn', '$Name', '$City')";
    mysqli_query($connection, $individual_insert_query) or die(mysqli_error($connection));
    
    $owner_id_query = "SELECT Owner_id FROM individual WHERE Ssn = '$Ssn'";
} elseif ($Name1 == "Bank") {
    $bank_insert_query = "INSERT INTO bank (Bid, Bname, City) 
                          VALUES ('$Bid', '$Bname', '$City')";
    mysqli_query($connection, $bank_insert_query) or die(mysqli_error($connection));
    
    $owner_id_query = "SELECT Owner_id FROM bank WHERE Bid = '$Bid'";
} else {
    $company_insert_query = "INSERT INTO company (Compid, Cname, City) 
                             VALUES ('$Compid', '$Cname', '$City')";
    mysqli_query($connection, $company_insert_query) or die(mysqli_error($connection));
    
    $owner_id_query = "SELECT Owner_id FROM company WHERE Compid = '$Compid'";
}

$owner_result = mysqli_query($connection, $owner_id_query);
$owner_row = mysqli_fetch_assoc($owner_result);
$owner_id = $owner_row['Owner_id'];

// Step 4: Insert into `owns` table
if ($owner_id != null) {
    $owns_insert_query = "INSERT INTO owns (Vehicle_id, Owner_id, Ctype) 
                          VALUES ('$vehicle_id', '$owner_id', '$Ctype')";
    mysqli_query($connection, $owns_insert_query) or die(mysqli_error($connection));
}

// Step 5: Display the Vehicle and Owner Information
echo "<h3>Vehicle ID is: $vehicle_id</h3>";
echo "<h3>Owner ID is: $owner_id</h3>";
?>

</body>
</html>
