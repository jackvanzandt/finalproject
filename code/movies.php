<?php
header('Content-Type: application/json');

include 'db_connect.php';

$query = 'SELECT movie_id, title, summary, release_year, director_id FROM movies';
$stid = oci_parse($conn, $query);
oci_execute($stid);

$movies = [];
while ($row = oci_fetch_assoc($stid)) {
    $movies[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

// converts to JSON
echo json_encode($movies);

