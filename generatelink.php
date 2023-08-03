<?php include './fun.php' ?>
<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';

$data = file_get_contents('php://input');
$d = json_decode($data, true);
$id = 'unique_' . $d['id'];


$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM `user_share` WHERE identification = '" . $id . "'";
} else {
    $sql = "SELECT * FROM `sharething` WHERE identification = '" . $id . "'";
}



$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $e =  base64_encode($id);
    $j =  base_url() . $e;
    if (isset($_SESSION['user'])) {
        $user_data = "UPDATE user_share SET link = '$j' WHERE user_id = {$_SESSION["user_id"]} && identification = '" . $id . "'";
        $data_ = mysqli_query($conn, $user_data);
        if ($data_) {
        }
    }
    echo json_encode(['url' => $j]);
} else {
    echo json_encode(['ok' => 0]);
} ?>