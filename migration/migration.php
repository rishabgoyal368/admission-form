<?php
include_once('../db.php');

$data = [
    ['state' => 'Punjab', 'city' => 'Bathinda'],
    ['state' => 'Punjab', 'city' => 'Jaito'],
    ['state' => 'Hariyana', 'city' => 'Gurgaon'],
    ['state' => 'Hariyana', 'city' => 'Ambala'],
    ['state' => 'Rajasthan', 'city' => 'Jaipur'],
];

// Create a states table
$query = "CREATE TABLE IF NOT EXISTS states (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)";

if ($conn->query($query) === TRUE) {
    // Create a cities table with a foreign key
    $query = "CREATE TABLE IF NOT EXISTS cities (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        state_id INT NOT NULL,
        FOREIGN KEY (state_id) REFERENCES states(id)
    )";

    if ($conn->query($query) === TRUE) {
        foreach ($data as $item) {
            $state = $conn->real_escape_string($item['state']);
            $city = $conn->real_escape_string($item['city']);

            // Check if the state exists in the states table
            $state_query = "SELECT id FROM states WHERE name = '$state'";
            $state_result = $conn->query($state_query);

            if ($state_result && $state_result->num_rows > 0) {
                $state_row = $state_result->fetch_assoc();
                $state_id = $state_row['id'];
            } else {
                // If the state does not exist, insert it
                $conn->query("INSERT INTO states (name) VALUES ('$state')");
                $state_id = $conn->insert_id;
            }

            // Insert the city into the cities table
            $conn->query("INSERT INTO cities (name, state_id) VALUES ('$city', $state_id)");
        }

        echo "Cities and states tables created and populated successfully.";
    } else {
        echo "Error creating cities table: " . $conn->error;
    }
} else {
    echo "Error creating states table: " . $conn->error;
}


$query =
    "CREATE TABLE IF NOT EXISTS course_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    fee DECIMAL(10, 2) NOT NULL
)";

if ($conn->query($query) === TRUE) {
    echo "Course Info table created successfully.";
} else {
    echo "Error creating Course Info table: " . $conn->error;
}

$insertQueries = [
    "INSERT INTO course_info (course_name, duration, fee) VALUES ('BCA', '3 years', 5000.00)",
    "INSERT INTO course_info (course_name, duration, fee) VALUES ('MCA', '2 years', 6000.00)",
    "INSERT INTO course_info (course_name, duration, fee) VALUES ('Btech', '4 years', 7000.00)",
];

foreach ($insertQueries as $query) {
    if ($conn->query($query) !== TRUE) {
        echo "Error inserting data: " . $conn->error;
        exit();
    }
}

// Create the admissions table
$query =
    "CREATE TABLE IF NOT EXISTS admissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    father_name VARCHAR(255) NOT NULL,
    mother_name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    state_id INT NOT NULL,
    city_id INT NOT NULL,
    dob DATE NOT NULL,
    age INT NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (state_id) REFERENCES states(id),
    FOREIGN KEY (city_id) REFERENCES cities(id),
    FOREIGN KEY (course_id) REFERENCES course_info(id)
)";

if ($conn->query($query) === TRUE) {
    echo "Admissions table created successfully.";
} else {
    echo "Error creating admissions table: " . $conn->error;
}

echo "Data inserted into the Course Info table successfully.";

$conn->close();
