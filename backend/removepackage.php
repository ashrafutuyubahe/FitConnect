<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnection.php';

    if (isset($_POST['package_name']) && isset($_POST['package_price']) && isset($_POST['package_description'])) {
        $package_id= $_POST['pack-id'];
        if (!empty($package_id)) {
            $removePackage = "DELETE * FORM package_table WEHERE package_id='$package_id'";
            $result = mysqli_query($dbconn, $removePackage);

            if ($result) {
                echo 'Package removed successfully';
            } else {
                
                echo 'Failed to remove package. Error: ' . mysqli_error($dbconn);
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
