<?php
// Check if package_id is provided via POST request
if (isset($_POST['pack_id'])) {
    // Retrieve package_id from POST data
    $package_id = $_POST['pack_id'];

    // Connect to your database
    $host = "localhost";
    $name = "root";
    $dbname = "gymfit";
    $password = "";

    $dbconn = mysqli_connect($host, $name, $password, $dbname);

    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare a SQL statement to delete the package
    $sql = "DELETE FROM booked_packages WHERE pack_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($dbconn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $package_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Package removed successfully";
        } else {
            echo "Error removing package: " . mysqli_error($dbconn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($dbconn);
    }

    // Close connection
    mysqli_close($dbconn);
} else {
    echo "Package ID not provided";
}
?>
