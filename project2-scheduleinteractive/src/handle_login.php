<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/10/2015
 * Time: 6:30 PM
 */

session_start();

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";

$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//checks to see if email was entered
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //grabs maker id from db
    $maker_id = mysqli_query($con, "SELECT * FROM Makers WHERE M_email='$email'");
    $maker_id = mysqli_fetch_assoc($maker_id);
    $_SESSION["valid_login"] = $maker_id['M_num'];


    //checks to see if email is valid, redirecting to login screen otherwise
    if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM Makers WHERE M_email='$email' AND M_password='$password';"))>0) {
        header("Refresh:0; url=options.php");
    } else {
        $_SESSION["error"] = "--your email/password was not recognized--";
        header("Refresh:0; url=login.php");
    }
}

mysqli_close($con);
?>
