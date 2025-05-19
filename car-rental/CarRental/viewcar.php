<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>View Cars</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
    // Database connection
    $database_host = "localhost";
    $database_user = "root";
    $database_pass = "";
    $database_name = "car_rental_m";
    $connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);

    if (mysqli_connect_errno()) {
        die("Failed connecting to MySQL database. Invalid credentials" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    }

    // Check if Ctype is set from the POST request
    if (isset($_POST["Ctype"])) {
        // Fetch Ctype from POST request
        $Ctype = $_POST["Ctype"];
        
        // Debugging: Print Ctype value
        echo "<p><strong>Selected Car Type:</strong> $Ctype</p>"; 

        // Prepare the query to prevent SQL injection
        $stmt = $connection->prepare("SELECT C.Vehicle_id, C.License_no, C.Model, C.Year, R.Daily_Rate, R.Weekly_Rate
                                      FROM car AS C
                                      JOIN rates AS R ON C.Vehicle_id = R.Vehicle_id
                                      WHERE C.Ctype = ?");
        
        // Bind the Ctype variable to the query and execute
        $stmt->bind_param("s", $Ctype); // "s" means string
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            echo "<h1>".$Ctype." Cars</h1>";
        } else {
            echo "<h1>No cars found for this category.</h1>";
        }

        // Display cars in a table if found
        echo "<center><table>";
        echo "<tr>
                <th>Vehicle ID</th>
                <th>License No</th>
                <th>Model</th>
                <th>Year</th>
                <th>Daily Rate</th>
                <th>Weekly Rate</th>
              </tr>";

        // Loop through the result set and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["Vehicle_id"] . "</td>";
            echo "<td>" . $row["License_no"] . "</td>";
            echo "<td>" . $row["Model"] . "</td>";
            echo "<td>" . $row["Year"] . "</td>";
            echo "<td>" . $row["Daily_Rate"] . "</td>";
            echo "<td>" . $row["Weekly_Rate"] . "</td>";
            echo "</tr>";
        }
        echo "</table></center>";
    } else {
        echo "<h1>No car type selected</h1>";
    }

    // Close the connection
    mysqli_close($connection);
?>
</body>
</html>
