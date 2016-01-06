<?php
session_start();
if(!isset($_SESSION['valid_login'])){
    header("Refresh:0; url=login.php");
}

//db info
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

$schedule_id = $_GET['schedule_id'];
$user_id = $_GET['user_id'];

echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
  <html>
  <head>Select Your Meeting Times</head>
  <body>
  <table border='1'>
    <tr>
      <th>User</th>
      <th>Action</th>";

//grabs timeslots to render
$result = mysqli_query($con, "SELECT * FROM Schedule_TimeSlots WHERE S_id='$schedule_id'");


//sets date and time across the top
$count = 0;
if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['S_date'];
    $time = $row['S_time'];
    echo "<th> $date  @  $time  </th>";
    $count++;
    }
}
echo "</tr><tr>";

$_SESSION['count'] = $count;
$_SESSION['schedule_id'] = $schedule_id;
$_SESSION['user_id'] = $user_id;

$result = mysqli_query($con, "SELECT * FROM Users WHERE `S_id`='$schedule_id'");
//puts check boxes in appropriate row
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['U_name'];
        echo "<tr><th> $name  </th>";
        if ($row['U_id'] == $user_id) {
            echo "<td>
                <form action='finalize_new_schedule.php' method='POST'><input type='submit' value='Submit'/>
              </td>";

            for ($i = 0; $i < $count; $i++) {
                echo "<td><input type='checkbox' name=$i></td>";
            }

        } else {
            for ($i = 0; $i <= $count; $i++) {
                echo "<td></td>";
            }
        }
    }
}

mysqli_close($con);
?>