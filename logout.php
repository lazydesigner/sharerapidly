<?php
session_start();
session_unset();  # Unset all of the session variables
if(session_destroy()){
    header('Location: .');
}

?>