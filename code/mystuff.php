<?php
include 'db_connect.php';

// Placeholder for the logged-in user ID
$user_id = 1;  // This would typically come from a session variable

$query = "SELECT ms.my_stuff_id, m.title AS movie_title, t.title AS show_title FROM my_stuff ms LEFT JOIN movies m ON ms.movie_id = m.movie_id LEFT JOIN tv_shows t ON ms.tv_show_id = t.tv_show_id WHERE ms.user_id = :user_id";
$stid = oci_parse($conn, $query);
oci_bind_by_name($stid, ":user_id", $user_id);

oci_execute($stid);

$myStuff = [];
while ($row = oci_fetch_assoc($stid)) {
    $myStuff[] = $row;
}

oci_free_statement($stid);
oci_close($conn);

echo json_encode($myStuff);
