<?php
$server = "localhost";
$username = "root";
$password = "123";
$db = "ikaze";

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        $stmt = $conn->prepare("INSERT INTO `project v3` (User_Name, Email) VALUES (?, ?)");
        $stmt->bind_param("ss", $fnm, $email);
        $fnm = $_POST['name'];
        $email = $_POST['email'];
        if ($stmt->execute()) {
            echo "Data successfully recorded";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        break;
    case 'GET':
        if (!isset($_GET['page'])) {     
            $pageNumber = 1;
        } else {
            $pageNumber = $_GET['page'];
        }

        $limit = 5;
        $offset = ($pageNumber - 1) * $limit;

        $query = "SELECT * FROM `project v3` LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);
        $arra = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $arra[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($arra);
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT['id'];
        $name = $_PUT['username'];
        $email = $_PUT['email'];
        $stmt = $conn->prepare("UPDATE `project v3` SET User_Name=?, Email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
        if ($stmt->execute()) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => $stmt->error));
        }
        $stmt->close();
        break;
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'];
        $stmt = $conn->prepare("DELETE FROM `project v3` WHERE id=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => $stmt->error));
        }
        $stmt->close();
        break;
}

$conn->close();
?>
