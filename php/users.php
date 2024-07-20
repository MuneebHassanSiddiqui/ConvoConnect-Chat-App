<?php
session_start();
include "config.php";

$outgoing_id = $_SESSION['unique_id'];

$sql_all = mysqli_query($conn, "SELECT * FROM users WHERE NOT  unique_id = {$outgoing_id}");
$output = "";

if (mysqli_num_rows($sql_all) > 0) {
    while ($row = mysqli_fetch_assoc($sql_all)) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
        OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query);
        if ($row2) {
            $result = $row2['msg'];
        } else {
            $result = "No message available";
        }

        (strlen($result) > 28 ? $msg = substr($result, 0, 28) . '....' : $msg = $result);
        ($row2 && $outgoing_id == $row2['outgoing_msg_id'] ? $you = "You: " : $you = "");
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
 
      
        $output .= '    
        <a href="chat.php?user_id=' . $row["unique_id"] . '">
            <div class="content">
                <img class="image" src="php/imagesfolder/' .  $row['img'] . '" style="border-radius: 50%;   width:50px; height: 50px;"  />
                <div class="details">
                    <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
        </a>';
        
    }
      
} else {
    $output .= "No users are available";
}

echo $output;

