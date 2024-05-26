<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $postdata = file_get_contents("php://input");
    
    
    if (!empty($postdata)) {
        
        $data = json_decode($postdata);
        
        
        if (isset($data->package_name) && isset($data->package_date)) {
           
            include 'dbconnection.php';
            
            
            $package_name = $data->package_name;
            $package_date = $data->package_date;
            
            
            $insertQuery = "INSERT INTO booked_packages (package_name, booked_date) VALUES ('$package_name', '$package_date')";
            $result = mysqli_query($dbconn, $insertQuery);
            
           
            if ($result) {
             
                echo json_encode(array("message" => "Package booked successfully"));
            } else {
                
                echo json_encode(array("error" => "Failed to book package"));
            }
        } else {
            
            echo json_encode(array("error" => "Package name or date is missing"));
        }
    } else {
        
        echo json_encode(array("error" => "No data received"));
    }
} else {
    // Send error response if request method is not POST
    echo json_encode(array("error" => "Invalid request method"));
}
?>
