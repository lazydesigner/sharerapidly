
<?php
function isLocalServer()
{
    // Define a list of common local server hostnames or IP addresses
    $localHostnames = array('localhost', '127.0.0.1', '::1');

    // Get the server's hostname or IP address
    $serverHost = $_SERVER['HTTP_HOST'];

    // Check if the server's hostname or IP address is in the list of local hostnames
    return in_array($serverHost, $localHostnames);
}

// Example usage:
if (isLocalServer()) {
    // Local server settings
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'shareanything';
    
    $conn = mysqli_connect($host, $user, $pass, $db);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
} else {
    // Live server settings
    $host = 'localhost';
$user = 'u654976059_dsfvddf';
$pass = '@Smile1427';
$db = 'u654976059_dsfvddf';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
}

// Use the $databaseHost, $databaseUsername, $databasePassword, and $databaseName variables in your application for database connection or other settings.
?>