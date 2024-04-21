<?php
header('Content-Type: application/json');
include 'db_connect.php';

$query = 'SELECT m.movie_id, m.title, m.summary, m.release_year, d.first_name, d.last_name 
          FROM movies m
          LEFT JOIN directors d ON m.director_id = d.director_id'; 

$stid = oci_parse($conn, $query);
if (!oci_execute($stid)) {
    $e = oci_error($stid); 
    echo json_encode(['error' => $e['message']]);
    exit;
}

$movies = [];
while ($row = oci_fetch_assoc($stid)) {

    error_log("First Name: " . $row['FIRST_NAME'] . ", Last Name: " . $row['LAST_NAME']);

    if(!empty($row['FIRST_NAME']) && !empty($row['LAST_NAME'])){
        $row['director_name'] = $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'];
    } else {
        $row['director_name'] = 'Unknown Director';
    }
    $movies[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

echo json_encode($movies);

