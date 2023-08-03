<?php

function createZip($source, $destination)
{
    // Check if the source path is a valid file or folder
    if (!file_exists($source)) {
        throw new Exception("Source file/folder not found.");
    }

    // Initialize the ZipArchive object
    $zip = new ZipArchive();

    // Open the ZIP file for writing
    if ($zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        throw new Exception("Unable to create ZIP archive.");
    }

    // Check if the source is a single file or a folder
    if (is_file($source)) {
        // Add the file to the ZIP archive
        $zip->addFile($source, basename($source));
    } elseif (is_dir($source)) {
        // Recursively add all files and folders inside the source directory
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                // Get the relative path of the file from the source directory
                $relativePath = substr($file, strlen($source) + 1);

                // Add the file to the ZIP archive with its relative path
                $zip->addFile($file, $relativePath);
            }
        }
    } else {
        // Invalid source type (not a file or folder)
        $zip->close();
        throw new Exception("Invalid source type. Only files and folders are supported.");
    }

    // Close the ZIP archive
    $zip->close();

    return true;
}




try {
    $source = "./uploaded/VID_20211118_180249_1.mp4";
    $destination = "./abcd.zip";

    createZip($source, $destination);

    echo "ZIP archive created successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}





?>