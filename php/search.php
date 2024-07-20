<?php

include "config.php";

session_start();
$outgoing_id = $_SESSION['unique_id'];

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != {$outgoing_id} AND (fname LIKE '%$searchTerm%' OR lname LIKE '%$searchTerm%')");


$output = "";
if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
        OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query);
        if (mysqli_num_rows($query) > 0) {
            $result = $row2['msg'];
        } else {
            $result = "No message available";
        }

        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '....' : $result;
        ($row2 && $outgoing_id == $row2['outgoing_msg_id'] ? $you = "You: " : $you = "");
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        $output .= '    
        <a href="chat.php?user_id=' . $row["unique_id"] . '">
            <div class="content">
                <img class="image" src="php/imagesfolder/' . $row['img'] . '" style = "border-radius:50px; width:50px;" />
                <div class="details"> 
                    <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
        </a>';
    }
} else {
    $output .= "No user found";
}
echo $output;

