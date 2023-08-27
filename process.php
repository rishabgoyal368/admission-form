<?php
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $name = $conn->real_escape_string($_POST['name']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $email = $conn->real_escape_string($_POST['email']);
    $father_name = $conn->real_escape_string($_POST['father_name']);
    $mother_name = $conn->real_escape_string($_POST['mother_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $state = $conn->real_escape_string($_POST['state']);
    $city = $conn->real_escape_string($_POST['city']);
    $dob = $_POST['dob'];
    $age = (int)$_POST['age'];
    $gender = $conn->real_escape_string($_POST['gender']);
    $course = $conn->real_escape_string($_POST['course']);

    // Insert data into the admissions table
    $query = "INSERT INTO admissions (name, mobile, email, father_name, mother_name, address, state_id, city_id, dob, age, gender, course_id) VALUES ('$name', '$mobile', '$email', '$father_name', '$mother_name', '$address', '$state', '$city', '$dob', $age, '$gender', '$course')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['success_message'] = "Form submitted successfully.";

        echo "Form submitted successfully!";
        header("Location: index.php");
        exit();
    } else {
        echo "Error submitting form: " . $conn->error;
    }
}

$conn->close();
