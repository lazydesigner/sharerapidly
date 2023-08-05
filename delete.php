<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
date_default_timezone_set('Asia/Kolkata');
include './connection.php';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data = file_get_contents('php://input');
$data = json_decode($data, true);
$id = $data['id'];
$slug = $data['slug'];

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM `user_share` WHERE id = $id AND identification = '$slug'";
} else {
    $sql = "SELECT * FROM `sharething` WHERE id = $id AND identification = '$slug'";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['download_count'] == 1) {

        if (isset($_SESSION['user'])) {
            $sql = "DELETE FROM `user_share` WHERE id = $id AND identification = '$slug'";
        } else {
            $sql = "DELETE FROM `sharething` WHERE id = $id AND identification = '$slug'";
        }
        $result = mysqli_query($conn, $sql);
        $unlink = './' . $row['image_path'] . '';
        if (file_exists($unlink)) {
            if (unlink($unlink)) {
                echo json_encode(['status'=>200]);
            }
        }
        myFunction($conn);
    } else {
        $count = $row['download_count'] - 1;

        if (isset($_SESSION['user'])) {
            $sql = "UPDATE user_share SET download_count='$count' WHERE id = $id AND identification = '$slug'";
        } else {
            $sql = "UPDATE sharething SET download_count='$count' WHERE id = $id AND identification = '$slug'";
        }
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        myFunction($conn);
    }
}

function myFunction($conn)
{
    $presentDate = date('Y-m-d H:i:s');

    if (isset($_SESSION['user'])) {
        $sql = "SELECT * FROM `user_share` WHERE expiry <= '$presentDate' ";
    } else {
        $sql = "SELECT * FROM `sharething` WHERE expiry <= '$presentDate' ";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            if (isset($_SESSION['user'])) {
                $sql1 = "DELETE FROM `user_share` WHERE id = " . $row['id'] . "";
            } else {
                $sql1 = "DELETE FROM `sharething` WHERE id = " . $row['id'] . "";
            }
            $result = mysqli_query($conn, $sql1);
            $unlink = './' . $row['image_path'] . '';
            if (file_exists($unlink)) {
                if (unlink($unlink)) {
                    echo 'File successfully deleted from the folder.';
                }
            }
            myFunction($conn);
        }
    }
}
