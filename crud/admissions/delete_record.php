<?php
include_once('../../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $query = "DELETE FROM admissions WHERE id = $id";
    $result = $conn->query($query);

    if (true) {
        $response = [
            'success' => true,
            'message' => 'Record deleted successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error deleting record: ' . $conn->error
        ];
    }
    echo json_encode($response);
} else {
    echo "Invalid request.";
}
