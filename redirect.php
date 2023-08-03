<?php 
$data = file_get_contents('php://input');
$data = json_decode($data,true);
$id = base64_encode($data['id']);
$slug = base64_encode($data['slug']);
header('Location: downloadfile/'.$slug.'/'.$id.'');


?>