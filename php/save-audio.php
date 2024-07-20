<?php
include "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'audiofiles/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $uniqueFilename = uniqid() . '-' . time() . '.' . pathinfo($_FILES['audio']['name'], PATHINFO_EXTENSION);
        $uploadFile = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadFile)) {
            $sqlaudio = "INSERT INTO uploaded_files (filename) VALUES ('$uploadFile')";
            mysqli_query($conn, $sqlaudio);
        } else {
            echo "not uploaded!";
        }
    }
}
