<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include "config.php";

    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";

    $sql = "SELECT  messages.*,  users.img, uploaded_files.filename AS audio_filename FROM  messages
            LEFT JOIN 
                users ON users.unique_id = messages.outgoing_msg_id
            LEFT JOIN 
                uploaded_files ON messages.msg_id = uploaded_files.msg_id
            WHERE 
                (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
                OR 
                (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}')
            ORDER BY msg_id";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                // Outgoing message
                $output .= '<div class="chat outgoing">
                <img src="php/imagesfolder/' . htmlspecialchars($row['img']) . '" 
                style="border-radius: 50%; height:36px; width:36px; position: relative; left: 375px;" /> 
                            <div class="details">';
                if ($row['msg_type'] == 'text' && !empty($row['msg'])) {
                    $output .= '<b><p style="  position:relative; right: 20px; background-color:#77ddaa;" >' . htmlspecialchars($row['msg']) . '</p></b>';
                } elseif ($row['msg_type'] == 'audio' && !empty($row['audio_filename'])) {
                    $output .= '<audio controls>
                                    <source src="php/audiofiles/' . htmlspecialchars($row['audio_filename']) . '" type="audio/wav">
                                </audio>';
                }
                $output .= '</div></div>';
            } else {
                // Incoming message
                $output .= '<div class="chat incoming">
                <img src="php/imagesfolder/' . htmlspecialchars($row['img']) . '" style="border-radius: 50%; height:36px; width:36px;" />
                <div class="details">';
                if ($row['msg_type'] == 'text' && !empty($row['msg'])) {
                    $output .= '<b><p style = "background-color:#333; color:white;">' . htmlspecialchars($row['msg']) . '</p></b>';
                } elseif ($row['msg_type'] == 'audio' && !empty($row['audio_filename'])) {
                    $output .= '<audio controls>
                                    <source src="php/audiofiles/' . htmlspecialchars($row['audio_filename']) . '" type="audio/wav">
                                </audio>';
                }
                $output .= '</div></div>';
            }
        }
        echo $output;
    } else {
        echo '<b style="color: #e74c3c; font-size: 18px; display: block; text-align: center; margin: 20px 0;">No messages found.</b>';
    }
} else {
    header("Location: ../login.php");
}
