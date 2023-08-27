<?php
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course'])) {
    $selectedCourse = $conn->real_escape_string($_POST['course']);

    $query = "SELECT * FROM course_info WHERE id = '$selectedCourse'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseDetails = [
            'success' => true,
            'course_name' => $row['course_name'],
            'duration' => $row['duration'],
            'fee' => $row['fee']
        ];
        echo json_encode($courseDetails);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
