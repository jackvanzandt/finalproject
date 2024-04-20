<?php
header('Content-Type: application/json');
include 'db_connect.php';

$query = 'SELECT tv_show_id, title, summary, release_year FROM tv_shows';
$stid = oci_parse($conn, $query);
oci_execute($stid);

$tv_shows = [];
while ($row = oci_fetch_assoc($stid)) {
    $tv_shows[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

header('Content-Type: application/json');
echo json_encode($tv_shows);

