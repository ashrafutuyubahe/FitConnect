<?php
// update-profile.php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection file
    include 'dbconnection.php';

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    
// Validate form data (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($oldPassword) || empty($newPassword)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Perform additional validation if needed (e.g., check if email format is valid)

    // Check if the old password matches the one stored in the database for the user
    // Assuming you have a table called 'users' with columns 'email' and 'password'
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$oldPassword'";
    $result = mysqli_query($dbconn, $query);

    if (mysqli_num_rows($result) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect old password.']);
        exit;
    }

    // Update the user's profile with the new data
    $updateQuery = "UPDATE users SET name = '$name', email = '$email', password = '$newPassword' WHERE email = '$email'";
    $updateResult = mysqli_query($dbconn, $updateQuery);

    if ($updateResult) {
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
