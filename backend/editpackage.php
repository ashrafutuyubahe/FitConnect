<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php';

    // Method override for PUT
    if(isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
        parse_str(file_get_contents('php://input'), $_PUT);
    }

    if (isset($_POST['package_name']) && isset($_POST['package_price']) && isset($_POST['package_description'])) {
        $package_name = $_POST['package_name'];
        $package_price = $_POST['package_price'];
        $package_description = $_POST['package_description'];
        $package_id = $_POST['package_id'];

        if (!empty($package_name) && !empty($package_price) && !empty($package_description)) {
            $updatePackage = "UPDATE package_table SET package_name='$package_name', package_price='$package_price', package_description='$package_description' WHERE package_id='$package_id'";
            $result = mysqli_query($dbconn, $updatePackage);

            if ($result) {
                echo 'Package updated successfully';
            } else {
                echo 'Failed to update package. Error: ' . mysqli_error($dbconn);
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
