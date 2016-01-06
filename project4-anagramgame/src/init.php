<?php

//database info
require_once('dbconfig.php');
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DATABASE);

//intialize words table
mysqli_query($con,"CREATE TABLE `Words` (
  `word` text NOT NULL
)");

//open dictionary file and read in all words
$fh = fopen("dictionary.txt", 'r');
while(($word1 = fgets($fh)) !== false){
    $word2 = fgets($fh);
    $word3 = fgets($fh);
    $word4 = fgets($fh);
    $word5 = fgets($fh);
    $word6 = fgets($fh);
    $word7 = fgets($fh);
    $word8 = fgets($fh);
    $word9 = fgets($fh);
    $word10 = fgets($fh);
    $word11 = fgets($fh);
    $word12 = fgets($fh);
    $word13 = fgets($fh);
    $word14 = fgets($fh);
    $word15 = fgets($fh);
    $word16 = fgets($fh);
    $word17 = fgets($fh);
    $word18 = fgets($fh);
    $word19 = fgets($fh);
    $word20 = fgets($fh);
    $word21 = fgets($fh);
    $word22 = fgets($fh);
    $word23 = fgets($fh);
    $word24 = fgets($fh);
    $word25 = fgets($fh);
    $word26 = fgets($fh);
    $word27 = fgets($fh);
    $word28 = fgets($fh);
    $word29 = fgets($fh);
    $word30 = fgets($fh);
    $word31 = fgets($fh);
    $word32 = fgets($fh);


    //trim each read in word
    $word1 = trim($word1);
    $word2 = trim($word2);
    $word3 = trim($word3);
    $word4 = trim($word4);
    $word5 = trim($word5);
    $word6 = trim($word6);
    $word7 = trim($word7);
    $word8 = trim($word8);
    $word9 = trim($word9);
    $word10 = trim($word10);
    $word11 = trim($word11);
    $word12 = trim($word12);
    $word13 = trim($word13);
    $word14 = trim($word14);
    $word15 = trim($word15);
    $word16 = trim($word16);
    $word17 = trim($word17);
    $word18 = trim($word18);
    $word19 = trim($word19);
    $word20 = trim($word20);
    $word21 = trim($word21);
    $word22 = trim($word22);
    $word23 = trim($word23);
    $word24 = trim($word24);
    $word25 = trim($word25);
    $word26 = trim($word26);
    $word27 = trim($word27);
    $word28 = trim($word28);
    $word29 = trim($word29);
    $word30 = trim($word30);
    $word31 = trim($word31);
    $word32 = trim($word32);

    //inserts 32 words at a time into the db
    mysqli_query($con, "insert into words (`word`) values ('$word1'),('$word2'),('$word3'),('$word4'),
                                                          ('$word5'),('$word6'),('$word7'),('$word8'),
                                                          ('$word9'),('$word10'),('$word11'),('$word12'),
                                                          ('$word13'),('$word14'),('$word15'),('$word16'),
                                                          ('$word17'),('$word18'),('$word19'),('$word20'),
                                                          ('$word21'),('$word22'),('$word23'),('$word24'),('$word25'),
                                                          ('$word26'),('$word27'),('$word28'),('$word29'),('$word30'),
                                                          ('$word31'),('$word32')");
}

//deletes blank rows
$blank = "";
mysqli_query($con, "delete from words where `word`='$blank'");

//close db conection
mysqli_close($con);
header("Refresh:0; url=anagram.php");
?>
