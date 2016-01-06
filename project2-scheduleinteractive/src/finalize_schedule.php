
<div style="text-align: center;"><h3>--choose which schedule you would like to finalize--</h3></div>

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

//grabs maker id
$maker_id = $_SESSION['valid_login'];

//grabs schedules from signed in makers
$result = mysqli_query($con, "SELECT * FROM Schedule_Info WHERE `S_maker`='$maker_id'");

//sets up radio buttons for each schedule
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div style=\"text-align: center;\"><form action='finish_finalizing.php' method='post'>";
        $schedule_name = $row['S_title'];
        echo "<input type='radio' name='schedule_name' value='$schedule_name'> $schedule_name </input>";
    }
}
echo "</br><input type='submit' value='Finlize'></div>";
mysqli_close($con);
?>
