<?php
include_once('db.php'); // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $query = "UPDATE admissions SET name = '$name', email = '$email' WHERE id = $id";
    $result = $conn->query($query);

    if ($result) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
