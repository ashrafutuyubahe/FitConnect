<?php
if (!isset($_GET['page'])) {     
    $pagenumber = 1;
} else {
    $pagenumber = $_GET['page'];
}

$server = "localhost";
$username = "root";
$password = 123;
$db = "ikaze";

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $limit = 5;
    $offset = ($pagenumber - 1) * $limit;

    $query = "SELECT * FROM `project v3`"; 
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    $totalpages = ceil($rows / $limit);

    $query = "SELECT * FROM `project v3` LIMIT $limit OFFSET $offset";
    $execute = mysqli_query($conn, $query);
    $arra = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $arra[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($arra);
}
?>
