<?php
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$response = array();

switch ($method) {
    case 'GET':
        // Retrieve items
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }
        break;

    case 'POST':
        // Add a new item
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $description = $data['description'];

        $sql = "INSERT INTO items (name, description) VALUES ('$name', '$description')";
        if ($conn->query($sql) === TRUE) {
            $response['message'] = "Item added successfully.";
        } else {
            $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case 'PUT':
        // Update an item
        // Implement this based on your needs
        break;

    case 'DELETE':
        // Delete an item
        // Implement this based on your needs
        break;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
