<?php
// File to be downloaded
$file = $_GET['path'];
include './fun.php';

// Set the appropriate headers
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Content-Length: ' . filesize($file));

// Read the file and output its contents

    // echo filesize($file);
readfile($file);
