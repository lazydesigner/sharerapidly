<?php
// File to be downloaded
// $file = $_GET['path'];
include_once './fun.php';

// // Set the appropriate headers
// header("Content-Description: File Transfer");
// header("Content-Type: application/octet-stream");
// header('Content-Disposition: attachment; filename="' . basename($file) . '"');
// header('Content-Length: ' . filesize($file));

// // Read the file and output its contents

//     // echo filesize($file);
// readfile($file);
// flush()


// Increase execution time and memory limit
set_time_limit(0);
ini_set('memory_limit', '512M'); // Adjust as needed

$file = $_GET['path'];
if (file_exists($file) && is_readable($file)) {
    // Open the file for reading
    $handle = fopen($file, 'rb');

    if ($handle !== false) {
        // Set the appropriate headers
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');

        // Read and send the file in chunks
        while (!feof($handle)) {
            echo fread($handle, 1024 * 1024); // Send 1MB chunk
            ob_flush();
            flush();
        }

        // Close the file handle
        fclose($handle);
    } else {
        // Handle file open error
        echo "Error opening the file.";
    }
} else {
    // Handle file not found or not readable
    echo "File not found or not readable.";
}



?>
