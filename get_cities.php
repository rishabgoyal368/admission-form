<?php
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['state_id'])) {
    $stateId = (int)$_POST['state_id'];
    $cities = [];

    // Retrieve cities for the selected state
    $result = $conn->query("SELECT * FROM cities WHERE state_id = $stateId");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cities[$row['id']] = $row['name'];
        }
    }

    echo json_encode(['success' => true, 'cities' => $cities]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
