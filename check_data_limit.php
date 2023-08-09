<?php
session_start();
include './connection.php';

$data = file_get_contents('php://input');

$data = json_decode($data,true);

$sql = "SELECT * FROM userdata AS t1 INNER JOIN priceing AS t2 ON t1.plan = t2.plan_id WHERE t1.email ='{$_SESSION['user_email']}' && t1.id = {$_SESSION['user_id']}";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
}else{
    echo mysqli_error($conn);
}

$count = formatBytes($row['data_transfer']);


$total_storage = parseFormattedSize($row['total_storage']);

if($row['total_storage'] == $count){
    echo json_encode(['status'=>500,'data_left'=>'$data_left']);
}else{
    $data_left =  $total_storage - $row['data_transfer'];
    if($data['filesize'] >= $data_left ){
        echo json_encode(['status'=>500,'data_left'=>$data_left]);
    }else{
        echo json_encode(['status'=>200]);
    }
    
}

?>

<?php

function formatBytes($bytes)
{
    if ($bytes > 0) {
        $i = floor(log($bytes) / log(1024));
        $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        return sprintf('%.02F', round($bytes / pow(1024, $i), 1)) * 1 . ' ' . @$sizes[$i];
    } else {
        return 0;
    }
}

function parseFormattedSize($sizeString)
{
    $sizeParts = explode(' ', $sizeString);
    if (count($sizeParts) !== 2) {
        return 0; // Invalid format, return 0
    }

    $size = (float) $sizeParts[0];
    $unit = strtoupper($sizeParts[1]);

    $unitIndex = array_search($unit, ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']);
    if ($unitIndex === false) {
        return 0; // Invalid unit, return 0
    }

    return $size * pow(1024, $unitIndex);
}


?>