<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/10/2015
 * Time: 2:57 PM
 */

//set user variables
$DB_USER="root";
$DB_PASSWORD="";
$DB_HOST="localhost";
$DB_DATABASE="assignment2";

//open connection
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_DATABASE);

//intialize Makers table
mysqli_query($con,"CREATE TABLE `Makers` (
  `M_name` text NOT NULL,
  `M_email` text NOT NULL,
  `M_password` text NOT NULL,
  `M_num` text NOT NULL
)");

//hard code makers
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Makers` (`M_name`, `M_email`, `M_password`, `M_num`) VALUES ('Cole Thomas', 'schafer.cole24@gmail.com', 'password', '0')");
mysqli_query($con, "INSERT INTO `".$DB_DATABASE."`.`Makers` (`M_name`, `M_email`, `M_password`, `M_num`) VALUES ('Cole Schafer', 'cts5ws@virginia.edu', 'password', '1')");

//Users
mysqli_query($con,"CREATE TABLE `Users` (
  `U_name` text NOT NULL,
  `U_email` text NOT NULL,
  `U_id` text NOT NULL,
  `S_id` text NOT NULL,
  `S_slots` text NOT NULL
)");

//schedule_info
mysqli_query($con,"CREATE TABLE `Schedule_Info` (
  `S_id` text NOT NULL,
  `S_title` text NOT NULL,
  `S_maker` text NOT NULL
)");

//schedule_timeslots
mysqli_query($con,"CREATE TABLE `Schedule_TimeSlots` (
  `S_id` text NOT NULL,
  `S_date` text NOT NULL,
  `S_time` text NOT NULL
)");

mysqli_close($con);
header("Refresh:0; url=login.php");
?>
