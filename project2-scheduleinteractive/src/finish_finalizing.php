<?php

session_start();
if(!isset($_SESSION['valid_login'])){
    header("Refresh:0; url=login.php");
}

//mail paths and variables
$mailpath = 'C:\xampp\htdocs\assignment_2\src\phpmailer';
$path = get_include_path();
set_include_path($path . PATH_SEPARATOR . $mailpath);
require 'PHPMailerAutoload.php';


//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//grabs variables
$maker_id = $_SESSION['valid_login'];
$schedule_name = $_POST['schedule_name'];

//uses db to find schedule_id
$result = mysqli_query($con, "SELECT * FROM Schedule_Info WHERE `S_title`='$schedule_name'");
$result = mysqli_fetch_array($result);
$schedule_id = $result['S_id'];

//finding appropriate users
$result = mysqli_query($con, "SELECT * FROM Users WHERE `S_id`='$schedule_id'");

//sets up varialble to be used to find priority location
$cumulative_selection = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cumulative_selection .= "|" . $row['S_slots'];
    }
}
$cumulative_selection = ltrim($cumulative_selection, '|');
$numbers = explode('|' , $cumulative_selection);

//determines which spot is
$result = array_count_values($numbers);
arsort($result);
$result = array_flip($result);
$chosen_spot = current($result);


$count = 0;
$sel_date = "";
$sel_time = "";

//finds date and time based on index
$result = mysqli_query($con, "SELECT * FROM `Schedule_TimeSlots` WHERE `S_id`='$schedule_id'");
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        if($count == $chosen_spot){
            $sel_time = $row['S_time'];
            $sel_date = $row['S_date'];
        }

        $count = $count + 1;
    }
}

//finds users for the schedule
$result = mysqli_query($con, "SELECT * FROM `Users` WHERE `S_id`='$schedule_id'");

//emails user about finalized date and time
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['U_email'];
        $name = $row['U_name'];

        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "tls"; // sets tls authentication
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
        $mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port
        $mail->Username = "cole.test.email@gmail.com"; // email username
        $mail->Password = "Athlete10gm!"; // email password
        // Put information into the message
        $mail->addAddress($email);
        $mail->From = "admin@schedule.com";
        $mail->Subject = "Your schedule has been finalized!";
        $mail->Body = "Hello " . $name . ", Schedule: " . $schedule_name . " has been finalized to the Date: " . $sel_date . " and Time: " . $sel_time;
        $mail->send();
    }
}

mysqli_close($con);
?>

<div style="text-align: center;"><h2>--Emails were sent to all users of the schedule--</h2>
    <a href="options.php">click to return to the options menu</a></div>
