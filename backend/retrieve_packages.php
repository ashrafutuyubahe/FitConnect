<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $retrievePackage = "SELECT * FROM package_table";
    $result = mysqli_query($dbconn, $retrievePackage);

    if ($result) {
        $packages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $packages[] = $row;
        }
        echo json_encode($packages);
    } else {
        echo 'Failed to retrieve packages. Error: ' . mysqli_error($dbconn);
    }
} else {
    echo 'Bad request. Please try again.';
}
?>
