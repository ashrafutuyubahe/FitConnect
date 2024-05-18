<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searched'])) {
    $datasearched = $_POST['searched'];

    $server = "localhost";
    $username = "root";
    $password = 123;
    $db = "ikaze";

    $conn = new mysqli($server, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($datasearched)) {
        $query = "SELECT * FROM `project v3` WHERE User_Name LIKE '$datasearched%'  OR Email like '$datasearched%' limit 5 ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            $search_results = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $search_results[] = $row;
            }

            header('Content-Type: application/json');
            echo json_encode($search_results);
        } else {
            echo "No data found";
        }
    }

    $conn->close();
}

?>
