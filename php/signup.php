<?php
session_start();
include "config.php";

$Fname = mysqli_real_escape_string($conn, $_POST['fname']);
$Lname = mysqli_real_escape_string($conn, $_POST['lname']);
$Email = mysqli_real_escape_string($conn, $_POST['email']);
$Password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($Fname) && !empty($Lname) && !empty($Email) && !empty($Password)) {
    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT email from users WHERE email = '{$Email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "this email already exists!";
        } else {
            if (isset($_FILES['image'])) {
                $img_Name = $_FILES['image']['name'];
                $temp_Name = $_FILES['image']['tmp_name'];

                $img_Explode = explode(".", $img_Name);
                $img_Ext = end($img_Explode);
                $Extension = ['png', 'jpeg', 'jpg'];

                if (in_array($img_Ext, $Extension)) {
                    $time = time();
                    $new_img_name = $time . $img_Name;
                    if (move_uploaded_file($temp_Name, "imagesfolder/" . $new_img_name)) {
                        $status = "Active now";
                        $random_id = rand(time(), 10000000);

                        $sql_insert = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ('$random_id', '$Fname', '$Lname', '$Email', '$Password', '$new_img_name', '$status')");
                        if ($sql_insert) {
                            $sql_sess = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$Email}'");
                            $row = mysqli_fetch_assoc($sql_sess);
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo "success";
                        } else {
                            echo "Something went wrong!";
                        }
                    }
                } else {
                    echo "please select an image file - jpeg , jpeg & png!!";
                }
            } else {
                echo "please select an image file!";
            }
        }
    } else {
        echo "$Email - This email is not a valid email!";
    }
} else {
    echo "ALL INPUT FIELDS ARE REQUIRED";
}
