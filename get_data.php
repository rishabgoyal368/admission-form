<?php
include_once('db.php');

$query = "SELECT 
    admissions.*,
    states.name AS state_name,
    cities.name AS city_name
FROM 
    admissions
LEFT JOIN 
    states ON admissions.state_id = states.id
LEFT JOIN 
    cities ON admissions.city_id = cities.id;";

$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));
