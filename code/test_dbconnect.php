<?php
include 'db_connect.php';


$query = 'SELECT * FROM MOVIES';
$stid = oci_parse($conn, $query);
if (!oci_execute($stid)) {
    $e = oci_error($stid);
    echo "Something went wrong: " . $e['message'];
} else {
    echo "Data retrieved successfully:<br>";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
            echo ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . " ";
        }
        echo "<br>";
    }
}

oci_free_statement($stid);
oci_close($conn);
?>
