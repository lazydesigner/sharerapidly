<?php
session_start();

ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include './connection.php';
// $data = file_get_contents('php://input');
// $data = json_decode($data,true);
// $id = $data['id'];
// $slug = $data['slug'];

if(isset($_SESSION['user'])){
    $sql = "SELECT * FROM `user_share` WHERE id = ".base64_decode($_GET['id'])." AND identification = '". base64_decode($_GET['slug'])."'";
}else{
$sql = "SELECT * FROM `sharething` WHERE id = ".base64_decode($_GET['id'])." AND identification = '". base64_decode($_GET['slug'])."'";}
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    // $file_name = $row['image']; 
    // $file_data = $row['image_path'];
    // $file_size = $row['image_size'];
    // $file_type = $row['image_type'];
    // ini_set('zlib.output_compression', 'Off');
    // header('Content-Description: File Transfer');
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition: attachment; filename='.$file_name);
    // header('Content-Length: ' . filesize($file_data));
    // ob_end_clean();
    // readfile($file_data);
    // flush();
}else{  
    echo $sql;
    ?>
    <p>Link is Expired</p>
<?php
} ?>