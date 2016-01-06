<?php

//include db info
require_once('dbconfig.php');
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);

//get word from the front end
$word = $_REQUEST['word'];

//query the word
$result = mysqli_query($con, "select * from Words where `word`='$word'");

//return true if it was found, false otherwise
if(mysqli_num_rows($result) > 0){
    $array = array("isWord" => "true");
}
else {
    $array = array("isWord" => "false");
}

$JSONResult = json_encode($array);
echo $JSONResult;
?>