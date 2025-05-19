<?php
$connection = new mysqli("localhost", "root", "", "car_rental_m");

if ($connection->connect_errno) {
    die("Failed connecting to MySQL: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fname = $_POST["fname"];
    $Lname = $_POST["lname"];
    $Age = $_POST["age"];
    $Mobile = $_POST["mobile"];
    $Dlno = $_POST["dlno"];

    $stmt = $connection->prepare("INSERT INTO CHAUFFEUR(Fname, Lname, Age, Mobile, Dlno) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $Fname, $Lname, $Age, $Mobile, $Dlno);

    if ($stmt->execute()) {
        echo "<h3>New chauffeur has been successfully added</h3><br><br>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$connection->close();
?>
