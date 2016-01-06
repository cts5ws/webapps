<?php
session_start();

if(!isset($_SESSION['valid_login'])){
    header("Refresh:0; url=login.php");
}

//destroys session
session_destroy();
//back to login screen
header("Refresh:0; url=login.php");

?>

