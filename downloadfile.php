<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM `user_share` WHERE identification = '" . base64_decode($_GET['slug']) . "'";
} else {
    $sql = "SELECT * FROM `sharething` WHERE identification = '" . base64_decode($_GET['slug']) . "'";
}
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    header('Location: download/' . $_GET['slug'] . '');
} else {
    header('Location: download/' . $_GET['slug'] . '');
}
