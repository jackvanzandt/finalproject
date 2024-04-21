<?php
header('Content-Type: application/json');
include 'db_connect.php';

$query = 'SELECT director_id, first_name, last_name FROM directors';
$stid = oci_parse($conn, $query);
oci_execute($stid);

$directors = [];
while ($row = oci_fetch_assoc($stid)) {
    $directors[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

echo json_encode($directors);