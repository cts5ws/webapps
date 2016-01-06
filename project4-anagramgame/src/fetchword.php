<?php

//include database info
require_once('dbconfig.php');
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);

//selects random word from dictionary and sends it to the client
$res = mysqli_query($con, "select * from words order by rand() LIMIT 1");
$row = mysqli_fetch_array($res);

$myJSONString = json_encode($row);
echo $myJSONString;
?>
