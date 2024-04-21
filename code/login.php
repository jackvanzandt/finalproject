<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

$response = ['success' => false, 'message' => 'Invalid credentials'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT user_id, username, password FROM users WHERE username = :username";
    $stmt = oci_parse($conn, $query);
    
    oci_bind_by_name($stmt, ":username", $username);

    if (oci_execute($stmt)) {
        if ($row = oci_fetch_assoc($stmt)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $response['success'] = true;
                $response['message'] = 'Login successful';
            } else {
                $response['message'] = 'Password is incorrect';
            }
        } else {
            $response['message'] = 'Username does not exist';
        }
    } else {
        $e = oci_error($stmt);
        $response['message'] = 'Database error: ' . htmlentities($e['message']);
    }
    oci_free_statement($stmt);
} else {

    $response['message'] = 'Username and password are required';
}
oci_close($conn);

echo json_encode($response);

