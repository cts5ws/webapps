
<?php

session_start();
if(!isset($_SESSION['valid_login'])){
    header("Refresh:0; url=login.php");
}

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

$result = mysqli_query($con, "SELECT * FROM Schedule_Info");
$schedule_id = $result->num_rows + 1;
$maker_id = $_SESSION['valid_login'];
//echo $schedule_id;
//echo $maker_id;

//email setup
$mailpath = 'C:\xampp\htdocs\assignment_2\src\phpmailer';
$path = get_include_path();
set_include_path($path . PATH_SEPARATOR . $mailpath);
require 'PHPMailerAutoload.php';


//get needed variables
$schedule_name = $_POST["name"];
$dates = $_POST["dates"];
$users = $_POST["users"];
$users = explode(',', $users);



$days = explode(',', $dates);
foreach($days as $day){
    $day_split = explode('@', $day);
    $date = $day_split[0];
    $times = explode('|', $day_split[1]);
    foreach($times as $time){
        mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Schedule_TimeSlots` (`S_id`, `S_date`, `S_time`) VALUES ('$schedule_id', '$date', '$time')");
    }
}




mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Schedule_Info` (`S_id`, `S_title`, `S_maker`) VALUES ('$schedule_id', '$schedule_name', '$maker_id')");

//echo "<p>$schedule_name</p>";
//echo "<p>$dates</p>";
//echo "<p>$users</p>";
//print_r($users);

$i = 0;
while($i < sizeof($users)){
    if($i%2 == 0 ) {
        $name = $users[$i];
        $email = $users[$i + 1];

        $result = mysqli_query($con, "SELECT * FROM Users");
        $user_id = $result->num_rows + 1;
        mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Users` (`U_name`, `U_email`, `U_id`, `S_id`, `S_slots`) VALUES ('$name', '$email', '$user_id', '$schedule_id', '')");

        $url = "http://localhost:8080/assignment_2/src/table.php";
        $url .= "?schedule_id=" . $schedule_id . "&user_id=" . $user_id;

        //echo $schedule_id;
        //echo '|';
        //echo $user_id;

        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "tls"; // sets tls authentication
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
        $mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port
        //$mail->Username = "cs4501.fall15@gmail.com"; // email username
        //$mail->Password = "UVACSROCKS"; // email password
        $mail->Username = "cole.test.email@gmail.com"; // email username
        $mail->Password = "Athlete10gm!"; // email password


        $mail->addAddress($email);
        $mail->Subject = "You've Been Added to a New Schedule";
        $mail->Body = "Hello " . $name . ", please add your availability to this schedule: " . $url;
        $mail->send();

        //if(!$mail->send()) {
        //    echo 'Message could not be sent.';
        //    echo 'Mailer Error: ' . $mail->ErrorInfo;
        //}
        //else {
        //echo "Message was sent";
        //}

    }
    $i = $i + 1;
}

//header("Refresh:0; url=table.php");
mysqli_close($con);
?>

<div style="text-align: center;"><h2> Your schedule was made and an email was sent to all users</h2>
<a href="options.php">--click to return to the options page--</a></div>