<?php
$username = 'ADMIN';
$password = 'Bettyvz5858!';
$connection_string = "(description= (retry_count=20)(retry_delay=3)(address=(protocol=tcps)(port=1522)(host=adb.us-ashburn-1.oraclecloud.com))(connect_data=(service_name=ga27f5aaf2cc98d_project_medium.adb.oraclecloud.com))(security=(ssl_server_dn_match=yes)))";

//  connect to the Oracle database
$conn = oci_connect($username, $password, $connection_string);

// Check the connection
if (!$conn) {
    $e = oci_error();
    error_log($e['message'], 3, '/path/to/your/error_log.log'); // Log the error
    die('We are experiencing technical difficulties. Please try again later.'); 
}

