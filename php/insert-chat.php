<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    if (!empty($message)) {
        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                VALUES ('$incoming_id', '$outgoing_id', '$message')";

        if (mysqli_query($conn, $sql)) {
            echo "Message submitted successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Message is empty";
    }
} else {
    header("Location: ../login.php");
    exit();
}

