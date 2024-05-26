<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php';

    if (isset($_POST['package-name']) && isset($_POST['package-description'])) {
        $package_name = $_POST['package-name'];
        $package_description = $_POST['package-description'];
        
        if (!empty($package_name) && !empty($package_description)) {
            $insertPackage = "INSERT INTO package_table(package_name, package_description, package_date) VALUES ('$package_name', '$package_description', NOW())";
            $result = mysqli_query($dbconn, $insertPackage);

            if ($result) {
                echo 'Package added successfully';
            } else {
                echo 'Failed to add package. Error: ' . mysqli_error($dbconn);
            }
        } else {
            echo 'One or more fields are empty';
        }
    } else {
        echo 'One or more required fields are not set';
    }
} else {
    echo 'Bad request. Please try again.';
}
?>
