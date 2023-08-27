<?php
include('../../db.php');

try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT admissions.*, course_info.course_name AS course
          FROM admissions
          LEFT JOIN course_info ON admissions.course_id = course_info.id
          WHERE admissions.id = $id";

        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $record = $result->fetch_assoc();
            echo json_encode($record);
        } else {
            echo "Record not found.";
        }
    } else {
        echo "Invalid request.";
    }
} catch (\Throwable $th) {
    die($th->getMessage());
}
