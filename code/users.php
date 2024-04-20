<?php
header('Content-Type: application/json');
include 'db_connect.php';

$query = 'SELECT user_id, username, email FROM users';
$stid = oci_parse($conn, $query);
oci_execute($stid);

$users = [];
while ($row = oci_fetch_assoc($stid)) {
    $users[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

echo json_encode($users);
