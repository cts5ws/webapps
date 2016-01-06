<?php
session_start();
if(!isset($_SESSION['valid_login'])){
    header("Refresh:0; url=login.php");
}
?>

<div style="text-align: center;">
<form method="post" action="handle_new_schedule.php">

<h3> Schedule Name: </h3>
    <input name="name" type="text">

<h3> Dates: </h3>
    <h4>Use the following formatting: </br> 9-22-2015@9:00|10:00, </br> 9-23-2015@11:00|12:00</h4>
    <textarea type="text" cols="50" rows="10" name="dates" size="80"></textarea>

<h3>Names and Emails</h3>
    <h4>Use the following formatting: </br> gmail, schafer.cole24@gmail.com, </br> uva, cts5ws@virginia.edu</h4>
    <textarea type="text" cols="50" rows="10" name="users" size="80"></textarea>

    <p><input type="submit" value="submit"></p>

</form></div>