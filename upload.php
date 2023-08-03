<?php session_start();
include './fun.php'
?>
<?php
    include './connection.php';
    date_default_timezone_set('Asia/Kolkata');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    $file_s = 2 * 1024 * 1024 * 1024;
    if ($conn) {
        if (isset($_FILES["file"])) {
            if ($image_size < $file_s) {
                // 
                // Settings 
                $targetDir = 'uploaded';
                $cleanupTargetDir = true; // Remove old files 
                $maxFileAge = 15 * 3600; // Temp file age in seconds 


                // Create target dir 
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }

                // Get a file name 
                if (isset($_REQUEST["name"])) {
                    $fileName = $_REQUEST["name"];
                } elseif (!empty($_FILES)) {
                    $fileName = $_FILES["file"]["name"];
                } else {
                    $fileName = uniqid("file_");
                }

                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

                // Chunking might be enabled 
                $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
                $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


                // Remove old temp files     
                if ($cleanupTargetDir) {
                    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
                    }

                    while (($file = readdir($dir)) !== false) {
                        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                        // If temp file is current file proceed to the next     
                        if ($tmpfilePath == "{$filePath}.part") {
                            continue;
                        }

                        // Remove temp file if it is older than the max age and is not the current file 
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                            @unlink($tmpfilePath);
                        }
                    }
                    closedir($dir);
                }


                // Open temp file 
                if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                }

                if (!empty($_FILES)) {
                    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                    }

                    // Read binary input stream and append it to temp file 
                    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                } else {
                    if (!$in = @fopen("php://input", "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                }

                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }

                @fclose($out);
                @fclose($in);

                // Check if file has been uploaded 
                if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off  
                    rename("{$filePath}.part", $filePath);
                    // 

                    $presentDate = date('Y-m-d H:i:s');
                    $futureDate = date('Y-m-d H:i:s', strtotime($presentDate . ' +1 days'));
                    $identificatin =  'unique_' . $_POST['identification'];
                    $targetFile = "uploaded/" . basename($filePath);
                    $image_type = 'application/octet-stream';
                    $image_size = filesize($filePath);
                    $fileName = basename($filePath);
                    $fileSize = filesize($filePath);

                    $user_1 = "SELECT * FROM `userdata` WHERE id = {$_SESSION['user_id']} ";
                    $result22 = mysqli_query($conn, $user_1);
                    if (mysqli_num_rows($result22) > 0) {
                        $r = mysqli_fetch_assoc($result22);
                        if($r['plan'] == 2 || $r['plan'] == 3){
                            $count = 5;
                        }else{ $count = 1;}
                    }else{ $count = 1;}

                    if (isset($_SESSION['user'])) {
                        $query = "INSERT INTO user_share(`image`,`image_path`,`image_type`,`image_size` ,`identification`,`download_count`,`expiry`,`user_id`) VALUES ('$fileName','$targetFile','$image_type',$image_size ,'$identificatin',$count ,'$futureDate',{$_SESSION['user_id']} )";
                    } else {
                        $query = "INSERT INTO sharething(`image`,`image_path`,`image_type`,`image_size` ,`identification`,`expiry`) VALUES ('$fileName','$targetFile','$image_type',$image_size ,'$identificatin', '$futureDate' )";
                    }
                    if (mysqli_query($conn, $query)) {
                        if (isset($_SESSION['user'])) {
                            // STORING TOTAL DATA SEND BY THE USER
                            // Making Query to check if user present or not
                            $user_ = "SELECT * FROM `userdata` WHERE id = {$_SESSION['user_id']} ";
                            $result2 = mysqli_query($conn, $user_) or die();
                            if (mysqli_num_rows($result2) > 0) {
                                $r = mysqli_fetch_array($result2);
                                // Adding currrent data with previous data
                                $data = $r['data_transfer'] + $image_size;
                                $user_data = "UPDATE userdata SET data_transfer = $data WHERE id = {$_SESSION["user_id"]} ";
                                $data_ = mysqli_query($conn, $user_data) or die();
                                if ($data_) {
                                } else {
                                    echo json_encode(['error' => 'user data not updated']);
                                }
                            }
                        }
                        echo json_encode(['success' => 'File uploaded successfully.']);
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($conn);
                    }

                }
            } else {
                // header("Location: echo base_url()");
                echo json_encode(['error' => 'data limit exceded']);
            }
        } else {
            print_r($_FILES['file']);
            // echo "Error uploading file.";
        }
    } else {
        echo 'ok';
    }
    ?>  