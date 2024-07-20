<?php
session_start();
include "config.php";

$Email = mysqli_real_escape_string($conn, $_POST['email']);
$Password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($Email) && !empty($Password)) {
    $sql_check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$Email'AND password = '$Password'");
    if (mysqli_num_rows($sql_check) > 0) {
        $row = mysqli_fetch_assoc($sql_check);
        $status = "Active now";
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        if ($sql) {
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
        }
    } else {
        echo "Email or Password is incorrect!";
    }
} else {
    echo "All input fields are reqired";
}
