<?php

session_start();

//mail variables
$mailpath = 'C:\xampp\htdocs\assignment_2\src\phpmailer';
$path = get_include_path();
set_include_path($path . PATH_SEPARATOR . $mailpath);
require 'PHPMailerAutoload.php';

//db variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";

$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

$email = strip_tags($_POST["email"]);

//checks to see if email is associated with a maker
if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM Makers WHERE M_email='$email';"))>0){

    $query = mysqli_query($con, "SELECT M_password FROM Makers WHERE M_email='$email';");
    $query_array = mysqli_fetch_assoc($query);
    $password = $query_array['M_password'];

    $mail = new PHPMailer();
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets tls authentication
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
    $mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port

    $mail->Username = "cs4501.fall15@gmail.com"; // email username
    $mail->Password = "UVACSROCKS"; // email password

    // Put information into the message
    $mail->addAddress($email);
    $mail->Subject = " Schdule Password";
    $mail->Body = "Your schedule password for username '" . $email . "' is '" . $password . "'" ;
    
    // echo 'Everything ok so far' . var_dump($mail);
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else {
        echo "<div style=\"text-align: center;\">
                <h3>
                    --your email was found in the system--
                </h3>
                <h3>
                --you will receive an email with your current password--
                </h3>
                <a href='login.php'>
                    click to return to the login page
                </a>
              </div>";
    }

} else {
    echo "<div style=\"text-align: center;\">
                <h3>
                    --your email was not found in the system--
                </h3>
                <a href='login.php'>
                    click to return to the login page
                </a>
              </div>";
}

mysqli_close($con);
?>