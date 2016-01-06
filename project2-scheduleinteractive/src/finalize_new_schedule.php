<?php
session_start();

//grabs needed session variables
$count = $_SESSION['count'];
$schedule_id = $_SESSION['schedule_id'];
$user_id = $_SESSION['user_id'];

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//makes string to store as selected time slots
$str = "";
for ($i = 0; $i < $count; $i++){
    if(isset($_POST[$i])){
        $str .= $i."|";
    }
}
//remove the last '|' from the string
$str = trim($str, "|");
//echo $str;
$query = "UPDATE Users SET S_slots='$str' WHERE U_id=$user_id AND S_id=$schedule_id;";
mysqli_query($con, $query);
mysqli_close($con);
?>

<div style="text-align: center;"><h2>Your availability has been added</h2>
<h3>Thank you!</h3></div>
