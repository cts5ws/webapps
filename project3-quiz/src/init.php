<?php
session_start();

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment3";

//open connection
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//intialize Categories table
mysqli_query($con,"CREATE TABLE `Categories` (
  `C_id` text NOT NULL,
  `C_name` text NOT NULL
)");

//Questions
mysqli_query($con,"CREATE TABLE `Questions` (
  `C_id` text NOT NULL,
  `Q_num` text NOT NULL,
  `Q_question` text NOT NULL,
  `Q_choiceA` text NOT NULL,
  `Q_choiceB` text NOT NULL,
  `Q_choiceC` text NOT NULL,
  `Q_correct_choice` text NOT NULL
)");

//results
mysqli_query($con,"CREATE TABLE `Results` (
  `U_id` text NOT NULL,
  `C_id` text NOT NULL,
  `correct` text NOT NULL,
  `total` text NOT NULL
)");

//averages
mysqli_query($con,"CREATE TABLE `Averages` (
  `C_id` text NOT NULL,
  `correct` text NOT NULL,
  `total` text NOT NULL
)");


mysqli_close($con);
header("Refresh:0; url=db_init.php");
die;
?>
